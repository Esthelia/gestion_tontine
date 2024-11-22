@extends('layout.master')

@section('content')






<div style="margin-top:8rem; margin-left:20rem;">
    <i class="fa-solid fs-1 fa-person-shelter"></i>
    <span class="display-5 fw-bold">Gestion Membre</span><br>
    <small style="margin-left:3rem;">Ajouter Un Membre</small>
    <br><br>
       <!-- Breadcrumb -->
       <nav class="d-flex">
         <h6 class="mb-0">
           <a href="" class="text-reset">Administrateur</a>
             <span>/</span>
               <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
                 <span>/</span>
               <a href="{{route('Admin-ContributionGetCreate')}}" class="text-reset active"><u>Tontine</u></a>
         </h6>
       </nav>
       <br>
</div>       
   <hr>

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

   <div class="text-end">
    <a href="{{ route('Admin-MemberGetShow') }}" class="badge bg-danger text-white">
        Retour à la liste
    </a>
   </div>
</div>
   </div>
   <div class="card" style="width: 35rem; margin-left:33rem; margin-top:5rem;">
       <span class="card__title">Membre</span>
       <p class="card__content">
         Enregistrez un Membre
       </p>
        <br>
       <form method="POST" action="{{route('Admin-MemberPostStore')}}" class="card__form" enctype="multipart/form-data">
        @csrf

         <label for="file" class="custum-file-upload">
             <div class="text">
              <span>Cliquez pour télécharger votre image</span>
             </div>
              <input id="file" name="image" type="file" required>
         </label>

      
         <br><br>
         <div class="row mb-4">
           <div class="col">
             <div data-mdb-input-init class="form-outline">
               <label class="form-label" for="form3Example1">Nom et Prenom</label>
               <input type="text" name="fullname" id="form3Example1" placeholder="Entrez Votre et Prenom" class="form-control @error('fullname') is-invalid @enderror" required/>
             </div>

              @error('fullname')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
           </div>
           <div class="col">
             <div data-mdb-input-init class="form-outline">
               <label class="form-label" for="form3Example2">Telephone</label>
               <input type="text" name="phone" id="form3Example2" placeholder="Entrez votre numero de téléphone" class="form-control @error('phone') is-invalid @enderror" required/>

               @error('phone')
               <div class="invalid-feedback">{{ $message }}</div>
               @enderror
             </div>
           </div>
         </div>
       
         <!-- Email input -->
         <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Lieu d'habitation</label>
           <input type="geo_location" name="geo_location" id="form3Example3"  placeholder="Entrez le lieu ou vous habitez" class="form-control @error('geo_location') is-invalid @enderror" required/>

           @error('geo_location')
            <div class="invalid-feedback">{{ $message }}</div>
           @enderror
         </div>
       
         <!-- Password input -->
     
           <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Genre</label>
             <input type="text" name="gender" id="form3Example3"  placeholder="Entrez si vous etes ou une femme ou et un homme" class="form-control @error('gender') is-invalid @enderror" required/>

             @error('gender')
             <div class="invalid-feedback">{{ $message }}</div>
             @enderror
           </div>
           
       
         <!-- Submit button -->
         <button data-mdb-ripple-init type="submit" class="card__button">Valider</button>
     
     </form>
   </div>  

  



   <script>
    document.getElementById('file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const label = document.querySelector('.custum-file-upload');
                
                label.style.backgroundImage = `url(${e.target.result})`;
                label.style.backgroundColor = 'transparent'; // Optional: Remove default background color
            };
            
            reader.readAsDataURL(file);
        }
    });
   </script>
    
    




@endsection