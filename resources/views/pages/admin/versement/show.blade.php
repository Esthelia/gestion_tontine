@extends('layout.master')

@section('content')




<div style="margin-top:8rem; margin-left:20rem;">
    <i class="fa-solid fs-1 fa-piggy-bank"></i>
    <span class="display-5 fw-bold"> Gestion des Versements</span><br>
    <small style="margin-left:3rem;">Listes des des Versements enregistrés</small>
    <br><br>
       <!-- Breadcrumb -->
       <nav class="d-flex">
         <h6 class="mb-0">
           <a href="{{route('Admin-ReceptionGetShow')}}" class="text-reset">Reception de la Somme à Recuperer</a>
             <span>/</span>
               <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
                 <span>/</span>
               <a href="{{route('Admin-ContributionGetShow')}}" class="text-reset active"><u>Tontine</u></a>
               <span>/</span>
               <a href="{{route('Admin-PayementGetShow')}}" class="text-reset active"><u>Gestion Paiement</u></a>
         </h6>
       </nav>
       <br>
   <hr>
   <div class="text-end">
    <a href="{{ route('Admin-PayementGetShow') }}" class="badge bg-danger text-white">
        Retour à la liste
    </a>
   </div>
   <br><br>


  {{-- <table class="table table-dark table-striped" style="">
     <thead>
       <tr>
         <th scope="col">Tontine</th>
         <th scope="col">Adherant</th>
         <th scope="col">Montant</th>
         <th scope="col">Date</th>
         <th scope="col">Montant Doit Recuperer</th>
         <th scope="col">Actions</th>
       </tr>
     </thead>
     <tbody>
     @foreach ($versements as $versement)
       <tr>
         <td>{{$versement->payement->contribution->wording}} </td>
         <td>{{$versement->payement->member->fullname}} </td>
         <td>{{$versement->amount}}</td>
         <td>{{$versement->created_at->format('l d F Y H:i')}}</td>
         <td>
          <p>{{ number_format($versement->total_amount, 2) }}</p>
        </td>
         <td>
           <a href="{{route('Admin-ReceptionGetShow', $versement->id)}}" class="text-white btn btn-outline-secondary">Reception de Tontine</a>
           <a href="{{route('Admin-VersementPostDestroy', $versement->id)}}" class="text-white btn btn-outline-secondary">Suprimer</a>
         </td>
       </tr>
     @endforeach   
     </tbody> 
  </table> --}}





{{-- <table class="table table-bordered border-dark">
    <thead class="table-dark">
        <tr>
            <th scope="col">Tontine</th>
            <th scope="col">Nombre d'adhérents</th>
            <th scope="col">Adhérents</th>
            <th scope="col">Contribution Réglée</th>
            <th scope="col">Montant Restant à Payer</th>
            <th scope="col">Nbre de Fois Cotisé</th>
            <th scope="col">Somme à Récupérer</th> <!-- Nouvelle colonne -->
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groupedVersements as $group)
            @foreach ($group['versements'] as $versement)
                <tr>
                    @if ($loop->first)
                        <td rowspan="{{ $group['member_count'] }}">{{ $group['contribution']->wording ?? 'Vous avez fait aucun versement' }}</td>
                        <td rowspan="{{ $group['member_count'] }}">{{ $group['member_count'] ?? 'Vous avez fait aucun versement' }}</td>
                    @endif
                    <td>{{ $versement->payement->member->fullname ?? 'Vous avez fait aucun versement' }}</td>
                    <td>{{ $versement->amount ?? 'Vous avez fait aucun versement' }}</td>
                    <td>{{ $versement->status ?? 'Vous avez fait aucun versement' }}</td>
                    <td>{{ $versement->payement->quantity ?? 'Vous avez fait aucun versement' }}</td>
                    <td>{{ $group['total_amount'] }}</td> <!-- Montant Doit Récupérer -->
                    <td>{{ $versement->created_at->format('l d F Y H:i') }}</td>
                    <td>
                            <a href="{{ route('Admin-VersementGetEdit', $versement->id) }}" class="text-dark btn btn-outline-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('Admin-VersementPostDestroy', $versement->id) }}" method="POST" style="display:inline-block;">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="text-dark btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $versement->id }}">
                                  <i class="fa-solid fa-trash-can"></i>
                              </button>
  
                              <!-- Modal -->
                              <div class="modal fade" id="deleteModal-{{ $versement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $versement->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="deleteModalLabel-{{ $versement->id }}">Confirmation de suppression</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer cet élément ? Ce versement est sur la liste de réception 
                                            et sa suppression pourrait affecter le suivi des paiements. Cliquez sur "Confirmer" pour supprimer ou sur "Annuler" pour revenir en arrière.
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                              <button type="submit" class="btn btn-danger">Confirmer</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </form>


                    </td>
                    
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table> --}}



<table class="table table-bordered border-dark">
  <thead class="table-dark">
      <tr>
          <th scope="col">Tontine</th>
          <th scope="col">Nombre d'adhérents</th>
          <th scope="col">Adhérents</th>
          <th scope="col">Contribution Réglée</th>
          <th scope="col">Montant Restant à Payer</th>
          <th scope="col">Nbre de Fois Cotisé</th>
          <th scope="col">Somme à Récupérer</th> <!-- Nouvelle colonne -->
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($groupedVersements as $group)
          @foreach ($group['versements'] as $versement)
              <tr>
                  @if ($loop->first)
                      <td rowspan="{{ $group['member_count'] }}">{{ $group['contribution']->wording ?? 'Vous avez fait aucun versement' }}</td>
                      <td rowspan="{{ $group['member_count'] }}">{{ $group['member_count'] ?? 'Vous avez fait aucun versement' }}</td>
                  @endif
                  <td>{{ $versement->payement->member->fullname ?? 'Vous avez fait aucun versement' }}</td>
                  <td>{{ $versement->amount ?? 'Vous avez fait aucun versement' }}</td>
                  <td>{{ $versement->status ?? 'Vous avez fait aucun versement' }}</td>
                  <td>{{ $versement->payement->quantity ?? 'Vous avez fait aucun versement' }}</td>
                  <!-- Calcul de la somme à récupérer -->
                  <td>{{ (($versement->amount ?? 0) * ($versement->payement->quantity ?? 0)) + ($versement->amount) }}</td>
                  <td>{{ $versement->created_at->format('l d F Y H:i') }}</td>
                  <td>
                      <a href="{{ route('Admin-VersementGetEdit', $versement->id) }}" class="text-dark btn btn-outline-secondary">
                          <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <form action="{{ route('Admin-VersementPostDestroy', $versement->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="text-dark btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $versement->id }}">
                              <i class="fa-solid fa-trash-can"></i>
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="deleteModal-{{ $versement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $versement->id }}" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="deleteModalLabel-{{ $versement->id }}">Confirmation de suppression</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          Êtes-vous sûr de vouloir supprimer cet élément ? Ce versement est sur la liste de réception 
                                          et sa suppression pourrait affecter le suivi des paiements. Cliquez sur "Confirmer" pour supprimer ou sur "Annuler" pour revenir en arrière.
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                          <button type="submit" class="btn btn-danger">Confirmer</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </td>
              </tr>
          @endforeach
      @endforeach
  </tbody>
</table>



</div>  





@endsection