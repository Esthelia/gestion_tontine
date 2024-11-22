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
</div>    
<hr>

<div class="text-end">
  <a href="{{ route('Admin-PayementGetShow') }}" class="badge bg-danger text-white">
      Retour à la liste
  </a>
 </div>


        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" style="width: 35rem; margin-left:35rem;" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" style="width: 35rem; margin-left:35rem;" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif 



{{-- <div class="card" style="width: 35rem; margin-left:33rem; margin-top:5rem;">
    <span class="card__title">Versement</span>
    <p class="card__content">
      Enregistrez un versement
    </p>
     <br>
  <form method="POST" action="{{route('Admin-VersementPostStore')}}" class="card__form">
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
        <input type="text" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Entrez le montant required pour obtenir la cotisation total" required>

        @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      
      
      
        
    
      <!-- Submit button -->
      <button data-mdb-ripple-init type="submit" class="card__button">Valider</button>
  
  </form>
</div>   --}}




<div class="card" style="width: 35rem; margin-left:33rem; margin-top:5rem;">
  <span class="card__title">Versement</span>
  <p class="card__content">Enregistrez un versement</p>
  <br>
  <form method="POST" action="{{ route('Admin-VersementPostStore') }}" class="card__form">
      @csrf

      <div>
          <p>
              (Mrs/Mme), <strong>{{ $payement->member->fullname ?? 'Membre supprimé' }}</strong><br>
              Vous allez faire un versement de <strong>{{ number_format($payement->contribution->sum, 2) }} FCFA</strong> pour la <strong>{{ $payement->contribution->wording ?? 'Libellé supprimé' }}</strong> que vous avez souscrite. <br>
              Vous avez la possibilité de solder à votre rythme.
          </p>
          <p>
              Quantité : <strong>{{ $payement->quantity ?? 0 }}</strong><br>
              **Total à cotiser** : <strong>{{ number_format(($payement->contribution->sum ?? 0) * ($payement->quantity ?? 0), 2) }} FCFA</strong>
          </p>
          <input type="hidden" name="payement_id" value="{{ $payement->id }}">
      </div>

      <div class="form-outline mb-4">
          <label class="form-label" for="amount">Entrez Le Montant</label>
          <input type="text" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Entrez le montant requis pour obtenir la cotisation totale" required>

          @error('amount')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>

      <!-- Submit button -->
      <button data-mdb-ripple-init type="submit" class="card__button">Valider</button>
  </form>
</div>





@endsection