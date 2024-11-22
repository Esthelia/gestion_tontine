@extends('layout.master')

@section('content')


<div style="margin-top:8rem; margin-left:20rem;">
  <i class="fa-solid fs-1 fa-piggy-bank"></i>
  <span class="display-5 fw-bold"> Gestion Tontines</span><br>
  <small style="margin-left:3rem;">Listes des Tontines enregistrés</small>
  <br><br>
     <!-- Breadcrumb -->
     <nav class="d-flex">
       <h6 class="mb-0">
          <a href="{{route('Admin-ReceptionGetShow')}}" class="text-reset">Reception de la Somme à Recuperer</a>
          <span>/</span>
          <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
          <span>/</span>
          <a href="{{route('Admin-MemberGetShow')}}" class="text-reset active"><u>Membre</u></a>
          <span>/</span>
          <a href="{{ route('Admin-PayementGetShow') }}" class="text-reset">Gestion de Paiement</a>
          <span>/</span>
          <a href="{{route('Admin-VersementGetShow')}}" class="text-reset active"><u>Gestion de Versement</u></a>
       </h6>
     </nav>
     <br>
 <hr>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
 <div class="text-end">
  <a href="{{ route('Admin-ContributionGetCreate') }}" class="badge bg-danger text-white">
      ajouter une tontine
  </a>
 </div>
 <br>
<table class="table table-bordered border-dark">
  <thead class="table-dark">
    <tr>
      <th scope="col">Libellé</th>
      <th scope="col">Somme à Verser</th>
      <th scope="col">Frequence</th>
      <th scope="col">Nombrer</th>
      <th scope="col">Description</th>
      {{-- <th scope="col">Durée</th> --}}
      {{-- <th scope="col">Member</th> --}}
      {{-- <th scope="col">Montant Obtenir à la fin de la Cotisation</th> --}}
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($contributions as $contribution)
      <tr>
        <td>{{$contribution->wording}}</td>
        <td>{{$contribution->sum}}</td>
        <td>{{$contribution->payment}}</td>
        <td>{{$contribution->quantity}}</td>
        <td>{{$contribution->description}}</td>
        <td>
          <a href="{{route('Admin-PayementGetCreate', $contribution->id)}}" class="text-dark btn btn-outline-secondary">Attribuer <i class="fa-solid fa-users"></i></a>
          <a href="{{route('Admin-ContributionGetEdit', $contribution->id)}}" class="text-primary"><i class="fa-solid fa-pen-to-square"></i></a>
          {{-- <a href="{{route('Admin-ContributionPostDestroy', $contribution->id)}}" class="text-primary"><i class="fa-solid fa-trash-can"></i></a> --}}
          <form action="{{ route('Admin-ContributionPostDestroy', $contribution->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" class="text-primary btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $contribution->id }}">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        
            <!-- Modal -->
            <div class="modal fade" id="deleteModal-{{ $contribution->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $contribution->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $contribution->id }}">Confirmation de suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Êtes-vous sûr de vouloir supprimer cette ligne de tontine ? Elle figure actuellement sur la liste des tontines 
                          et des versements, et sa suppression pourrait impacter le suivi des paiements. Cliquez sur "Confirmer" pour supprimer ou sur "Annuler" pour annuler l'action.
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
  </tbody>
</table>



<script>
  // Simplifiez le code JavaScript pour les alertes
  const alertSuccess = document.getElementById('alert-success');
  const alertDanger = document.getElementById('alert-danger');

  if (alertSuccess) {
      alertSuccess.classList.remove('fade');
      alertSuccess.classList.remove('d-none');
      setTimeout(() => {
          alertSuccess.classList.add('fade');
          alertSuccess.classList.add('d-none');
      }, 2000);
  }

  if (alertDanger) {
      alertDanger.classList.remove('fade');
      alertDanger.classList.remove('d-none');
      setTimeout(() => {
          alertDanger.classList.add('fade');
          alertDanger.classList.add('d-none');
      }, 2000);
  }
</script>


@endsection