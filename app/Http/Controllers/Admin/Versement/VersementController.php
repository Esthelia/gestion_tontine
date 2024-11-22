<?php

namespace App\Http\Controllers\Admin\Versement;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Member;
use App\Models\Payement;
use App\Models\Versement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VersementController extends Controller
{
    public function getShow() {
                         
        try {
            $user = auth()->user();
            $groupedVersements = Versement::where('user_id', $user->id)
                ->with(['payement.contribution', 'payement.member'])
                ->get()
                ->groupBy('payement.contribution.id')
                ->map(function ($group) {
                    $firstPayement = $group->first();
                    if ($firstPayement && $firstPayement->payement && $firstPayement->payement->contribution) {
                        $contribution = $firstPayement->payement->contribution;
                        $totalContributionAmount = (float) $contribution->sum;
                        $memberCount = $group->pluck('payement.member.id')->unique()->count();

                        // Calcule le montant total payé par tous les membres de la contribution
                        $groupTotalPaid = $group->sum(function ($versement) {
                            return is_numeric($versement->amount) ? $versement->amount : 0;
                        });

                        // Détermine le montant restant pour chaque versement et le statut "Tout payé" ou "Montant restant"
                        $group->each(function ($versement) use ($totalContributionAmount) {
                            $amountPaidByMember = $versement->amount;
                            $versement->remaining_amount = $totalContributionAmount - $amountPaidByMember;
                            if ($amountPaidByMember > $totalContributionAmount) {
                                $versement->status = 'Montant Dépasse la contribution';
                            } elseif ($amountPaidByMember == $totalContributionAmount) {
                                $versement->status = 'Tout payé';
                            } else {
                                $versement->status = 'Montant restant: ' . number_format($versement->remaining_amount, 2);
                            }
                        });

                        return [
                            'contribution' => $contribution,
                            'members' => $group->pluck('payement.member.fullname')->unique(),
                            'total_amount' => $groupTotalPaid, // Total payé par tous les membres
                            'remaining_amount' => $totalContributionAmount - $groupTotalPaid,
                            'versements' => $group,
                            'member_count' => $memberCount,
                            'date' => $group->first()->created_at->format('l d F Y H:i'),
                        ];
                    } else {
                        // Handle the case where contribution is null
                        Log::error('Contribution is null');
                        return [
                            'contribution' => null,
                            'members' => [],
                            'total_amount' => 0,
                            'remaining_amount' => 0,
                            'versements' => $group,
                            'member_count' => 0,
                            'date' => $group->first()->created_at->format('l d F Y H:i'),
                        ];
                    }
                });

            return view('pages.admin.versement.show', [
                'groupedVersements' => $groupedVersements
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue: ' . $e->getMessage()]);
        }

    }

    public function PostComplete(Request $request, $id) {


            $request->validate([
                'remaining_amount' => [
                    'required',
                    'numeric',
                    function ($attribute, $value, $fail) use ($id) {
                        $versement = Versement::find($id);
                        if (!$versement) {
                            $fail('Le versement spécifié n\'existe pas.');
                        }
                    }
                ],
            ], [
                'remaining_amount.required' => 'Le montant restant est obligatoire.',
                'remaining_amount.numeric' => 'Le montant restant ne doit contenir que des chiffres sans espaces ou virgules.',
            ]);


            
            $versement = Versement::findOrFail($id);
            $remainingAmount = (float) $request->input('remaining_amount');

            // Logique pour compléter le paiement
            // Exemple: Ajoutez le montant restant au versement existant ou créez un nouveau versement

            // Mise à jour de la somme totale payée
            $versement->amount += $remainingAmount;
            $versement->save();

            // Rediriger ou retourner une réponse
            return redirect()->back()->with('success', 'Montant soldé avec succès.');
        }




    public function getCreate($id) {

      $user = auth()->user();
      $payement = Payement::find($id);
      

      return view('pages.admin.versement.create' , compact('payement','user'));
    }



    public function postStore(Request $request) {

      // dd($request->all());

    //   $versement = new Versement();
    //   $versement->firstOrCreate([
    //     'user_id' => Auth::id(),
    //     'payement_id' => $request->payement_id,
    //     'amount' => $request->amount,
    //   ]); 

    //   session()->put('versement_done_' . $versement->id, true);

    //   return redirect()->route('Admin-VersementGetShow')->with('success', 'Versement effectué avec succès.');




            
            $request->validate([
                'payement_id' => [
                    'required',
                    'integer',
                    'exists:payements,id',
                ],
                'amount' => [
                    'required',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        // Vérification si un versement avec les mêmes valeurs existe déjà
                        $exists = Versement::where([
                            ['user_id', Auth::id()],
                            ['payement_id', $request->payement_id],
                            ['amount', $value],
                        ])->exists();
            
                        if ($exists) {
                            $fail('Un versement avec ces mêmes valeurs existe déjà.');
                        }
            
                        // Récupérer la somme totale de la contribution pour le paiement actuel
                        $totalContribution = Payement::find($request->payement_id)->contribution->sum;
            
                        // Vérification si le montant est supérieur à la somme totale de la contribution
                        if ($value > $totalContribution) {
                            $fail('Le montant ne peut pas être supérieur à la somme totale de la contribution.');
                        }
                    }
                ],
            ], [
                'payement_id.required' => 'Le champ paiement est obligatoire.',
                'payement_id.integer' => 'Le paiement doit être un nombre entier.',
                'payement_id.exists' => 'Le paiement sélectionné n\'existe pas.',
                'amount.required' => 'Le montant est obligatoire.',
                'amount.numeric' => 'Le montant ne doit contenir que des chiffres sans espaces ou virgules.',
                'amount.min' => 'Le montant doit être supérieur ou égal à zéro.',
            ]);

            try {
                // Créer un nouveau versement si la validation est réussie
                $versement = Versement::create([
                    'user_id' => Auth::id(),
                    'payement_id' => $request->payement_id,
                    'amount' => $request->amount,
                ]);

                // Marquer le versement comme effectué dans la session
                session()->put('versement_done_' . $versement->id, true);

                // Redirection après la création réussie du versement
                return redirect()->route('Admin-VersementGetShow')->with('success', 'Versement effectué avec succès.');
            } catch (\Exception $e) {
                // Gestion des erreurs et des exceptions
                return back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement du versement. Veuillez réessayer plus tard.']);
            }




            // Validation des entrées






    }


    public function getEdit(Versement $versement) {

        $user = auth()->user();
        $payement = $versement->payement;

        return view('pages.admin.versement.edit', compact('versement','user','payement'));
    }


    
    public function postUpdate(Request $request, Versement $versement)
    {
        $versement->payement_id = $request['payement_id'] ?? 0;
        $versement->amount = $request['amount'];
        
        $versement->save();

        return redirect()->route('Admin-VersementGetShow');
    }

    
    
    public function postDestroy($id )
    {
        $versements = Versement::findOrFail($id);

        if ($versements) {
        $versements->delete();
        }

        return redirect()->route('Admin-VersementGetShow');
    }
}
