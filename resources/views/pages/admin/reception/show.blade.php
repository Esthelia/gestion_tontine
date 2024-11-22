@extends('layout.master')

@section('content')


<div style="margin-top:8rem; margin-left:20rem;">
    <i class="fa-solid fs-1 fa-piggy-bank"></i>
    <span class="display-5 fw-bold">Gestion de Reception</span><br>
    <small style="margin-left:3rem;">Listes Par de Ordre Ramassage de la Tontine</small>
    <br><br>
       <!-- Breadcrumb -->
       <nav class="d-flex">
         <h6 class="mb-0">
           <a href="" class="text-reset">Administrateur</a>
             <span>/</span>
               <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
                 <span>/</span>
               <a href="{{route('Admin-MemberGetCreate')}}" class="text-reset active"><u>Membre</u></a>
         </h6>
       </nav>
       <br>
   <hr>
   <div class="text-end">
     <a href="{{ route('Admin-VersementGetShow') }}" class="badge bg-danger text-white">
         Retour à la liste
     </a>
    </div>
   </div>

<div class="card" style="margin-left:20rem; width:60rem; margin-top:20px;">   
  <table class="table table-light table-striped">
    <thead>
        <tr>
            <th scope="col">Ordre</th>
            <th scope="col">Adhérent</th>
            <th scope="col">Somme à Récupérer</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($receptions as $versement)
            <tr>
                <td>{{ $versement->order }}</td>
                <td>{{ $versement->payement->member->fullname }}</td>
                <td>{{ number_format($versement->totalAmountPaid, 2) }}</td> <!-- Montant Doit Récupérer -->
            </tr>
        @endforeach   --}}


        @if($receptions->isEmpty())
        <tr>
            <td colspan="3" class="text-center">Aucune réception disponible.</td>
        </tr>
        @else
            @foreach ($receptions as $versement)
                <tr>
                    <td>{{ $versement->order }}</td>
                    <td>
                        @if($versement->payement && $versement->payement->member)
                            {{ $versement->payement->member->fullname }}
                        @else
                            Membre non trouvé
                        @endif
                    </td>
                    <td>{{ number_format($versement->totalAmountPaid, 2) }}</td> <!-- Montant Doit Récupérer -->
                </tr>
            @endforeach
        @endif
    </tbody>
</table>







</div>     


@endsection
