@extends('layout.sidebar')

@section('content')


<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">

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

        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="{{asset('images/draw2.png')}}" class="img-fluid">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="POST" action="{{route('Auth-RegisterPostStore')}}" enctype="multipart/form-data">
            @csrf

            <br><br><br><br><br>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Photo</label>
                <input type="file" name="image" id="form3Example3" class="form-control form-control-lg"
                  placeholder="Entrer photo de profil" required/>
            </div>

            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Nom</label>
                <input type="text" name="name" id="form3Example3" class="form-control @error('name') is-invalid @enderror form-control-lg"
                  placeholder="Entrer nom" required/>

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            



            <!-- Lastname input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Prenom</label>
                <input type="text" name="lastname" id="form3Example3" class="form-control @error('lastname') is-invalid @enderror form-control-lg"
                  placeholder="Entrer votre prenom" required/>

                @error('lastname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

           




            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Genre</label>
                <select class="form-select" id="gender" name="gender" aria-label="Sélectionnez votre genre" class="form-control @error('gender') is-invalid @enderror form-control-lg" required>
                  <option value="" disabled selected hidden>Entrez votre genre</option>
                  <option value="femme">Femme</option>
                  <option value="homme">Homme</option>
                </select>

                @error('gender')
		            <div class="invalid-feedback">{{ $message }}</div>
		            @enderror

            </div>

            


  
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Email</label>
              <input type="email" name="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror form-control-lg" placeholder="Enter a valid email address" required/>

              @error('email')
		          <div class="invalid-feedback">{{ $message }}</div>
		          @enderror

            </div>

            


  
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Mot de Passe</label>
              <input type="password" name="password" id="form3Example4" class="form-control @error('password') is-invalid @enderror form-control-lg" placeholder="Enter password" required/>

              @error('password')
		          <div class="invalid-feedback">{{ $message }}</div>
		          @enderror
              
            </div>

            
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Enregistrer</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Vous avez un compte? <a href="{{route('Auth-LoginGetShow')}}"
                  class="link-danger">Connectez-Vous</a></p>
            </div>
  
          </form>
          <br><br>
        </div>
      </div>
    </div>
</section>




@endsection