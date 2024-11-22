@extends('layout.master')

@section('content')





<div style="margin-top:8rem; margin-left:20rem;">
 <i class="fa-solid fs-1 fa-piggy-bank"></i>
 <span class="display-5 fw-bold">Gestion de Paiement</span><br>
 <small style="margin-left:3rem;">Enregistrez un paiement</small>
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


<div class="card" style="width: 35rem; margin-left:33rem; margin-top:5rem;">
    <span class="card__title">Paiement</span>
    <p class="card__content">
      Enregistrez un paiement
    </p>
     <br>
  <form method="POST" action="{{route('Admin-PayementPostStore')}}" class="card__form">
    @csrf
   
      <!-- Email input -->
    <div> 
     
        <div>
            <p>
                  Vous allez souscrire à une <strong>{{$contribution->wording}}</strong>, <br> d'un Montant de <strong>{{$contribution->sum}} Fcfa</strong>.
                  <input type="hidden" name="contribution_id" value="{{ $contribution->id }}">
            </p>
        </div>
        <br>
        {{-- <div class="form-outline mb-4">
          <label class="form-label" for="form3Example4">Resaisissez le Libellé de Votre Tontine</label>
          <select class="form-select" id="contribution" name="contribution_id" placeholder="Sélectionnez un membre" required>
                  <option value=""></option>
                 
                  <option value="{{ $contribution->id }}">{{ $contribution->wording }}</option>
                  
          </select>
        </div> --}}

        
        <!-- Password input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="member">Choisir le Membre qui participera à cette tontine</label>
          <select id="member" name="member_id" class="form-select @error('member_id') is-invalid @enderror" required>
              <option value="" disabled selected>Sélectionnez un membre</option>
              @foreach ($members as $member)
                  <option value="{{ $member->id }}">{{ $member->fullname }}</option>
              @endforeach
          </select>
      
          @error('member_id')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>


      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="form3Example3">Nombre</label>
        <input type="number" name="quantity" id="form3Example3" class="form-control @error('quantity') is-invalid @enderror" required/>

        @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      
     
    </div>   
    
        
    
      <!-- Submit button -->
      <button data-mdb-ripple-init type="submit" class="card__button">Valider</button>
  </form>
</div>  



@endsection