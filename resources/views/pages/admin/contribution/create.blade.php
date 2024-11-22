@extends('layout.master')

@section('content')





  <div style="margin-top:8rem; margin-left:20rem;">
  <i class="fa-solid fs-1 fa-piggy-bank"></i>
  <span class="display-5 fw-bold"> Gestion Tontine</span><br>
  <small style="margin-left:3rem;">Ajouter une Tontine</small>
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
    <a href="{{ route('Admin-ContributionGetShow') }}" class="badge bg-danger text-white">
        Retour à la liste
    </a>
  </div>
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
      <span class="card__title">Tontine</span>
      <p class="card__content">
        Enregistrez une tontine
      </p>
      <br>
    <form method="POST" action="{{route('Admin-ContributionPostStore')}}" class="card__form">
      @csrf
    
        
        
        <div class="row mb-4">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label class="form-label" for="form3Example1">Libellé</label>
              <input type="text" name="wording" id="form3Example1" placeholder="libellé" class="form-control @error('wording') is-invalid @enderror" required/>
              
              @error('wording')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          


          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label class="form-label" for="form3Example2">Somme</label>
              <input type="text" name="sum" id="form3Example2" placeholder="Entrez la somme doit-on versé" class="form-control  @error('sum') is-invalid @enderror" required/>

              @error('sum')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>


        </div>
      
  
      
        
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example4">Fréquence</label>
            <select class="form-select" id="payment" name="payment" aria-label="Sélectionnez la fréquence de paiement"  class="form-control  @error('payment') is-invalid @enderror" required>
              <option value="" disabled selected hidden>Entrez votre paiement journalière, hebdomadaire, mensuelle</option>
              <option value="journalière">Journalière</option>
              <option value="hebdomadaire">Hebdomadaire</option>
              <option value="mensuelle">Mensuelle</option>
            </select>

            @error('sum')
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
    
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Description</label>
            <input type="text" name="description" id="form3Example3" class="form-control @error('description') is-invalid @enderror" required/>

            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
      
      
       
        <button data-mdb-ripple-init type="submit" class="card__button">Valider</button>
    
    </form>
  </div>  



@endsection







