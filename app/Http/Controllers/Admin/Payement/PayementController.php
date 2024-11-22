<?php

namespace App\Http\Controllers\Admin\Payement;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Member;
use App\Models\Payement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PayementController extends Controller
{
    public function getShow() {
      
    try {   
          $user = auth()->user();
          $payements = Payement::where('user_id', $user->id)
          ->with('contribution') // Charger la relation contribution
          ->get();
          // dd($payements);
          return view('pages.admin.payement.show', compact('payements')); 

        } catch (\Exception $e) {    
        
          return back()->withErrors(['error' => 'Une erreur est survenue:.'. $e->getMessage()]);
        }  
    }


    public function getCreate($id)
    {
        $user = auth()->user();
        $members = Member::where('user_id', $user->id)->get();
        $contribution = Contribution::find($id);
        
      return view('pages.admin.payement.create', compact('members', 'contribution'));
    }


    public function postStore(Request $request) {
        
        // dd($request->all());
          // Validation des entrées
          $request->validate([
            'contribution_id' => 'required|integer|exists:contributions,id',
            'member_id' => [
                'required',
                'integer',
                'exists:members,id',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = Payement::where([
                        ['contribution_id', $request->contribution_id],
                        ['member_id', $value],
                    ])->exists();
        
                    if ($exists) {
                        $fail('Ce membre est déjà associé à cette Tontine, Sélectionnez un autre membre');
                    }
                }
            ],
        ], [
            'contribution_id.required' => 'Le champ contribution est obligatoire.',
            'contribution_id.exists' => 'La contribution sélectionnée n\'existe pas.',
            'member_id.required' => 'Le champ membre est obligatoire.',
            'member_id.exists' => 'Le membre sélectionné n\'existe pas.',
        ]);
        
  
          // Vérification de l'existence d'un paiement similaire
          $payement = Payement::where([
              ['user_id', Auth::id()],
              ['contribution_id', $request->input('contribution_id')],
              ['member_id', $request->input('member_id')],
              ['quantity', $request->input('quantity')],
          ])->first();
  
          if ($payement) {
              return back()->withErrors(['unique' => 'Ce membre que vous inscrire existe déjà.']);
          }
  
          // Créer un nouveau paiement si il n'existe pas
          Payement::create([
              'user_id' => Auth::id(),
              'contribution_id' => $request->input('contribution_id'),
              'member_id' => $request->input('member_id'),
              'quantity' => $request->input('quantity'),
          ]);
  
          // Redirection après la création réussie du paiement
          return redirect()->route('Admin-PayementGetShow');
      
    }

    public function postDestroy($id )
    {
        $payement = Payement::findOrFail($id);

        if ($payement) {
        $payement->delete();
        }

        return redirect()->route('Admin-PayementGetShow');
    }
}
