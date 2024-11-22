@extends('layout.master')

@section('content')




<section>
    <div class="container" style="margin-left:14rem; margin-top:7rem;">
        <div class="card shadow" style="width:53rem; margin-left:10rem;">
            <div class="card-header py-3">
                <h2 class="m-0 font-weight-bold text-secondary">Gestion de Profile</h2>
            </div>
        </div>
        <br><br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-lg-8 mb-4 mb-lg-0">
                <div class="card shadow mb-3" style="border-radius: .5rem; width:49rem; height:25rem;">
                    <div class="row g-0">
                    
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('dist/image/' . $user->gender . '.png') }}" alt="Avatar"
                                    class="img-fluid my-5" style="width: 120px;" />
                                <div class="list-group" style="width: 16rem;">
                                    <a href="{{ route('Admin-ProfileGetShow') }}"
                                        class="list-group-item list-group-item-action active" aria-current="true">
                                        Profil
                                    </a>
                                    <a href=""
                                        class="list-group-item list-group-item-action">Passe de Mot</a>    
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Nom</h6>
                                            <p class="text-muted">{{ $user->name }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Prenom</h6>
                                            <p class="text-muted">{{ $user->lastname }}</p>
                                        </div>
                                    </div>
                                    <h6>Projects</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Genre</h6>
                                            <p class="text-muted">{{ $user->gender }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-5 d-flex justify-content-between"> 
                                    <a href="{{route('Admin-ProfileGetEdit', $user->id)}}" class="btn btn-outline-primary">
                                        Modifier
                                    </a> 
                                    {{-- <a href="{{route('Admin-RegisterPostDestroy', $user->id)}}">
                                      <button type="submit" class="btn btn-primary">
                                        supprimer
                                      </button>  
                                    </a>  --}}
                                  </div>  
                                </div>  
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection