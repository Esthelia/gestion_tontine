@extends('layout.master')

@section('content')




<div style="margin-top:8rem; margin-left:20rem;">
    <i class="fa-solid fs-1 fa-piggy-bank"></i>
    <span class="display-5 fw-bold"> Gestion Membres</span><br>
    <small style="margin-left:3rem;">Listes des Membres enregistrés</small>
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
               <a href="{{route('Admin-PayementGetShow')}}" class="text-reset active"><u>Gestion de Paiement</u></a>
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
    <a href="{{ route('Admin-MemberGetCreate') }}" class="badge bg-danger text-white">
        ajouter un membre
    </a>
   </div>
   <br>
  <table class="table table-bordered border-dark">
    <thead class="table-dark">
      <tr>
        <th scope="col">Image</th>
        <th scope="col">Nom & Prenom</th>
        <th scope="col">Numero de Téléphone</th>
        <th scope="col">Lieu d'habitation</th>
        <th scope="col">Genre</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($members as $member)
      <tr>
        <td>
          <img src="{{ asset('storage/' . $member->image) }}" height="60" width="60" srcset="" style="width: 60px;height: 60px;">
        </td>
        <td>{{$member->fullname}}</td>
        <td>{{$member->phone}}</td>
        <td>{{$member->geo_location}}</td>
        <td>{{$member->gender}}</td>
        <td>
          <a href="{{route('Admin-MemberGetEdit', $member->id)}}" class="text-dark"><i class="fa-solid fa-pen-to-square"></i></a>
          {{-- <a href="{{route('Admin-MemberPostDestroy', $member->id)}}" class="text-danger"><i class="fa-solid fa-user-xmark"></i></a> --}}
          <form action="{{ route('Admin-MemberPostDestroy', $member->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" class="text-dark btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $member->id }}">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        
            <!-- Modal -->
            <div class="modal fade" id="deleteModal-{{ $member->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $member->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $member->id }}">Confirmation de suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer ce membre ? Car il a été inscrit à une tontine.
                            Si ce n'est pas le cas, cliquez sur "Annuler". Cliquez sur "Confirmer" pour valider la suppression.
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