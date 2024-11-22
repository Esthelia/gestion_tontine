@extends('layout.master')

@section('content')





<div style="margin-top:8rem; margin-left:20rem;">
 <i class="fa-solid fs-1 fa-piggy-bank"></i>
 <span class="display-5 fw-bold"> Gestion de Versement</span><br>
 <small style="margin-left:3rem;">Ajouter un versement</small>
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
</div>
<div class="text-end">
  <a href="{{ route('Admin-VersementGetShow') }}" class="badge bg-danger text-white">
      Retour à la liste
  </a>
 </div>
<div class="card" style="width: 35rem; margin-left:33rem; margin-top:5rem;">
    <span class="card__title">Versement</span>
    <p class="card__content">
      Enregistrez un versement
    </p>
     <br>
  <form method="POST" action="{{route('Admin-VersementPostUpdate',['versement' => $versement->id])}}" class="card__form">
    @csrf
    

     
      <div>
        <p>
            (Mrs/Mme), <strong>{{$payement->member->fullname ?? 0}}</strong>
            Vous allez faire un versement de <strong>{{$payement->contribution->sum}}</strong> pour la <strong>{{$payement->contribution->wording}}</strong>
            que vous avez souscrire. <br> Vous avez la possibilité de solder à votre rythme.
            <input type="hidden" name="payement_id" value="{{ $payement->id }}">
            <input type="hidden" name="payement_id" value="{{ $payement->id }}">
        </p>
      </div>
      


      <div class="form-outline mb-4">
        <label class="form-label" for="Amount_required">Entrez Le Montant</label>
        <input type="text" id="amount" name="amount" value="{{$versement->amount}}"  class="form-control" placeholder="Entrez le montant required pour obtenir la cotisation total" required>
      </div>

        
    
      <!-- Submit button -->
      <button data-mdb-ripple-init type="submit" class="card__button">Valider</button>
  
  </form>




</div>  



@endsection