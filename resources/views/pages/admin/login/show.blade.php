@extends('layout.sidebar')

@section('content')




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




<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="{{asset('images/draw2.png')}}" class="img-fluid">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="POST" action="{{route('Auth-LoginPostStore')}}">
            @csrf
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Email</label>
              <input type="email" name="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror form-control-lg"
                placeholder="Entrer une adresse email valide" required/>

              @error('email')
		          <div class="invalid-feedback">{{ $message }}</div>
		          @enderror
            </div>

            
  
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Mot de Passe</label>
              <input type="password" name="password" id="form3Example4" class="form-control @error('password') is-invalid @enderror form-control-lg"
                placeholder="Enter votre mot de passe" required/>
              

              @error('password')
		          <div class="invalid-feedback">{{ $message }}</div>
		          @enderror
            </div>


  
            {{-- <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body">Forgot password?</a>
            </div> --}}
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Connectez-Vous</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Vous n'avez pas de Compte? <a href="{{route('Auth-RegisterGetShow')}}"
                  class="link-danger">Inscrivez-Vous</a></p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
</section>





@endsection