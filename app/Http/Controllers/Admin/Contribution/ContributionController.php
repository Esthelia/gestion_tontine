<?php

namespace App\Http\Controllers\Admin\Contribution;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ContributionController extends Controller
{
  public function getShow()
  {
    $user = auth()->user();
    $contributions = Contribution::where('user_id', $user->id)
        ->with('member') // Charger la relation avec les membres
        ->get();
    // dd($contributions);
    return view('pages.admin.contribution.show', compact('contributions', 'user'));
  }


  public function getIndex($id)
  {

    $contribution = Contribution::find($id);
    return view('pages.admin.car.detail', compact('contribution'));
  }

  public function getCreate()
  {
    $user = auth()->user();
    $members = Member::all();

    return view('pages.admin.contribution.create', compact('members', 'user'));
  }

  public function getEdit(Contribution $contribution)
  {

    $members = Member::all();
    return view('pages.admin.contribution.edit', compact('contribution', 'members'));
  }

  public function postStore(Request $request)
  {

      $request->validate([
        'wording' => 'required|string|max:255',
        'sum' => 'required|numeric|min:0',
        'payment' => 'required|in:journalière,hebdomadaire,mensuelle',
        'quantity' => 'required|integer|min:1',
        'description' => 'required|string|max:500',
    ], [
        'wording.required' => 'Le libellé est obligatoire.',
        'sum.required' => 'La somme est obligatoire.',
        'sum.numeric' => 'La somme ne doit contenir que des chiffres sans espaces ou virgules',
        'payment.required' => 'La fréquence de paiement est obligatoire.',
        'payment.in' => 'La fréquence de paiement doit être journalière, hebdomadaire ou mensuelle.',
        'quantity.required' => 'Le nombre est obligatoire.',
        'quantity.integer' => 'Le nombre doit être un entier.',
        'description.required' => 'La description est obligatoire.',
    ]);
      // Recherche de contribution existante avec les mêmes valeurs
      $contribution = Contribution::where([
          ['user_id', Auth::id()],
          ['member_id', $request->member_id ?? 0],
          ['wording', $request->wording],
          ['sum', $request->sum],
          ['payment', $request->payment],
          ['quantity', $request->quantity],
          ['description', $request->description],
          ['duration', $request->duration ?? 0],
          ['Amount_required', $request->Amount_required ?? 0],
      ])->first();
  
      // Vérifier si une contribution similaire existe
      if ($contribution) {
          return back()->withErrors(['unique' => 'Une contribution avec ces mêmes valeurs existe déjà.']);
      }
  
      // Créer une nouvelle contribution si elle n'existe pas
      $contribution = Contribution::create([
          'user_id' => Auth::id(),
          'member_id' => $request->member_id ?? 0,
          'wording' => $request->wording,
          'sum' => $request->sum,
          'payment' => $request->payment,
          'quantity' => $request->quantity,
          'description' => $request->description,
          'duration' => $request->duration ?? 0,
          'Amount_required' => $request->Amount_required ?? 0,
      ]);
  
      // Redirection après la création réussie de la contribution
      return redirect()->route('Admin-ContributionGetShow', ['id' => $contribution->member_id]);
  }

  public function postUpdate(Request $request, Contribution $contribution)
  {
      // Validation des données de la requête
      $request->validate([
          'wording' => 'required|string|max:255',
          'sum' => 'required|numeric|min:0|regex:/^\d+$/', // Exige des nombres sans espaces ou virgules
          'payment' => 'required|in:journalière,hebdomadaire,mensuelle',
          'quantity' => 'required|integer|min:1',
          'description' => 'required|string|max:500',
      ], [
          'wording.required' => 'Le libellé est obligatoire.',
          'sum.required' => 'La somme est obligatoire.',
          'sum.numeric' => 'La somme ne doit contenir que des chiffres sans espaces ou virgules.',
          'sum.regex' => 'La somme ne doit contenir que des chiffres sans espaces ou virgules.',
          'payment.required' => 'La fréquence de paiement est obligatoire.',
          'payment.in' => 'La fréquence de paiement doit être journalière, hebdomadaire ou mensuelle.',
          'quantity.required' => 'Le nombre est obligatoire.',
          'quantity.integer' => 'Le nombre doit être un entier.',
          'description.required' => 'La description est obligatoire.',
      ]);

      // Mise à jour des attributs du modèle Contribution
      $contribution->wording = $request->wording;
      $contribution->sum = $request->sum;
      $contribution->payment = $request->payment;
      $contribution->quantity = $request->quantity;
      $contribution->description = $request->description;

      // Sauvegarde des modifications
      $contribution->save();

      // Redirection après la mise à jour réussie
      return redirect()->route('Admin-ContributionGetShow');
  }

  public function postDestroy($id)
  {
    $contribution = Contribution::findOrFail($id);

    if ($contribution) {
      $contribution->delete();
    }

    return redirect()->route('Admin-ContributionGetShow');
  }
}
