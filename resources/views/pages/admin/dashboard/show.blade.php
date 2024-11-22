@extends('layout.master')

@section('content')






<main class="position-relative" style="margin-top: 58px;">
    <div class="container pt-4">
        <div class="card p-5 bg-body-tertiary shadow mb-4 position-absolute top-0 start-0" style="z-index: 10; margin-top: 25rem; margin-left:17rem; width:66rem;">
            <h1 class="">Dashboard</h1>
            <!-- Breadcrumb -->
            <nav class="d-flex">
                <h6 class="mb-0">
                    <a href="{{route('Admin-ReceptionGetShow')}}" class="text-reset">Reception de la Somme à Recuperer</a>
                    <span>/</span>
                    <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
                    <span>/</span>
                    <a href="{{route('Admin-ContributionGetShow')}}" class="text-reset"><u>Tontine</u></a>
                    <span>/</span>
                    <a href="{{route('Admin-MemberGetShow')}}" class="text-reset active"><u>Membre</u></a>
                    <span>/</span>
                    <a href="{{route('Admin-PayementGetShow')}}" class="text-reset"><u>Gestion Paiements</u></a>
                    <span>/</span>
                    <a href="{{route('Admin-VersementGetShow')}}" class="text-reset active"><u>Gestion de Versement</u></a>
                </h6>
            </nav>
            <!-- Breadcrumb -->
        </div>
        <div id="carouselExampleCrossfade" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <img src="{{asset('images/caroussel-1.jpg')}}" class="d-block" style="width:70rem; height:30rem;" alt="Wild Landscape"/>
              </div>
              <div class="carousel-item">
                  <img src="{{asset('images/caroussel-2.jpg')}}" class="d-block" style="width:70rem; height:30rem;" alt="Camera"/>
              </div>
              <div class="carousel-item">
                  <img src="{{asset('images/caroussel-3.jpg')}}" class="d-block" style="width:70rem; height:30rem;" alt="Exotic Fruits"/>
              </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
      
      <div class="cards d-block">
          <div class="card-text text-white">
            <h1 style="text-align:center">Gestion de cotisations</h1>
            <br><br>
            <a href="{{route('Admin-ReceptionGetShow')}}" style="margin-left:17rem;" class="text-white btn btn-success">Listes Des Membres Pour receptionner Leur Tontine</a>
          </div>
      </div>

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
      
    </div>
</main>





@endsection