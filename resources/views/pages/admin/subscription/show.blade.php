@extends('layout.master')

@section('content')




<div style="margin-top:8rem; margin-left:20rem;">
    <i class="fa-solid fs-1 fa-piggy-bank"></i>
    <span class="display-5 fw-bold"> Gestion Des Listes de Tontines Par Catégories</span><br>
    <small style="margin-left:3rem;">Listes de Tontines Par Catégories enregistrés</small>
    <br><br>
       <!-- Breadcrumb -->
       <nav class="d-flex">
         <h6 class="mb-0">
           <a href="" class="text-reset">Administrateur</a>
             <span>/</span>
               <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
                 <span>/</span>
               <a href="{{route('Admin-ContributionGetShow')}}" class="text-reset active"><u>Tontine</u></a>
               <span>/</span>
               <a href="{{route('Admin-PayementGetShow')}}" class="text-reset active"><u>Gestion Paiment</u></a>
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
  <table class="table table-dark table-striped" style="">
   <form method="POST" action="{{route('Admin-VersementUpdateOrder')}}">
    @csrf
    <thead>
      <tr>
        <th scope="col">Adherant</th>
        <th scope="col">Montant</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($versements as $versement)
      <tr>
        <td>{{$versement->payement->fullname}}</td>
        <td>{{$versement->amount}}</td>
        <td>{{$versement->created_at->format('l d F Y H:i')}}</td>
        <td>
            <input type="checkbox" name="selected[{{ $versement->id }}]" value="1" {{ $versement->is_selected ? 'checked' : '' }}>
        </td>
        <td>
            <input type="number" name="order[{{ $versement->id }}]" value="{{ $versement->order }}" class="form-control" style="width: 60px;">
        </td>
        <td>
          <a href="{{route('Admin-ReceptionGetShow', $versement->id)}}" class="text-white btn btn-outline-secondary">Reception de Tontine</a>
          <a href="{{route('Admin-VersementPostDestroy', $versement->id)}}" class="text-white btn btn-outline-secondary">Suprimer</a>
          <button class="text-white btn btn-outline-secondary" type="submit">Valider</button>
        </td>
      </tr>
    @endforeach  
    </tbody>
   </form>  
  </table>
</div>  




@endsection