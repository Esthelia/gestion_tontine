<?php

namespace App\Http\Controllers\Admin\Reception;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Member;
use App\Models\Payement;
use App\Models\Versement;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
  public function getShow()
  {
      // Récupérer tous les versements avec leurs relations
      $user = auth()->user();
      $versements = Versement::where('user_id', $user->id)
          ->with('payement.member', 'payement.contribution')
          ->get();
    
      // Regrouper les versements par contribution
      $groupedVersements = $versements->groupBy(function($versement) {
          return $versement->payement->contribution_id ?? 'Vous avez fait aucun versement';
      });
    
      // Calculer le montant total payé par tous les membres pour chaque contribution
      $groupedVersements = $groupedVersements->map(function ($group, $contributionId) {
          $totalAmountPaid = $group->sum('amount');
    
          // Ajouter le montant total payé par tous les membres
          $group->each(function ($versement) use ($totalAmountPaid) {
              $versement->totalAmountPaid = $totalAmountPaid;
          });
    
          return $group;
      })->flatten();
    
      // Séparer les versements "Tout payé" de ceux avec montant restant
      $toutPayes = $groupedVersements->filter(function ($versement) {
          return $versement->status == "Tout payé";
      });

      $montantRestant = $groupedVersements->filter(function ($versement) {
          return $versement->status != "Tout payé";
      });

      // Trier les versements "Tout payé" par date, les plus anciens en premier
      $toutPayes = $toutPayes->sortBy('created_at');

      // Mélanger aléatoirement les versements avec montant restant
      $montantRestant = $montantRestant->shuffle();

      // Fusionner les versements, les versements "Tout payé" d'abord, suivis des versements avec montant restant
      $versements = $toutPayes->merge($montantRestant);

      // Ajouter l'ordre de récupération
      $versements = $versements->values()->map(function($versement, $index) {
          $versement->order = $index + 1;
          return $versement;
      });
    
      // Retourner la vue avec les versements
      return view('pages.admin.reception.show', ['receptions' => $versements]);
  }

  
}

