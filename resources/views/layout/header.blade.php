<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white mt-4" style="overflow-y: auto; padding-bottom: 100px; position: fixed; width: 250px;">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <div class="row d-flex justify-content-center">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('dist/image/' . Auth::user()->gender . '.png') }}" class="rounded-circle" style="width:160px; border-raduis:20px;" alt="Avatar">
                                </div>
                                  <h4 class="mb-2">
                                    {{ Auth::user()->name }}
                                    {{ Auth::user()->lastname }}
                                  </h4>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br> 
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('Admin-DashboardGetShow') }}" class="nav-link active" aria-current="page">
                            <i class="fa-solid fa-house-laptop"></i>
                            Tableau de bord
                        </a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#submenu2"
                            aria-expanded="false" aria-controls="submenu2">
                            <i class="fa-solid fa-piggy-bank"></i>
                            Gestions des Tontines
                            <i class="fa-solid fa-caret-down"></i>
                        </a>
                        <div class="collapse" id="submenu2">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{route('Admin-ContributionGetCreate')}}">Ajouter Une Tontine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{route('Admin-ContributionGetShow')}}">Listes des Tontines</a>   
                                </li>
                            </ul>
                        </div>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#submenu3"
                            aria-expanded="false" aria-controls="submenu3">
                            <i class="fa-solid fa-person-shelter"></i>
                            Gestions des Membres
                            <i class="fa-solid fa-caret-down"></i> <!-- Icône de la flèche -->
                        </a>
                        <div class="collapse" id="submenu3">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{route('Admin-MemberGetCreate')}}">Ajouter Un Membre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{route('Admin-MemberGetShow')}}">Listes des Membres</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>


                
                  
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar shadow navbar-expand-lg navbar-light bg-white fixed-top" style="height: 95px;">
    <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
            <img src="{{asset('images/tontine.png')}}" class="roun" style="width:140px; height:140px; margin-top:12px;" alt="MDB Logo" loading="lazy"/>
            </a>
            <!-- Search form -->
            {{-- <form class="d-none d-md-flex input-group w-auto my-auto">
            <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search' style="min-width: 225px; margin-left:20rem;"/>
            <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
            </form> --}}

            <!-- Notification dropdown -->
            <div class="dropdown">
                <a href="#" class=" text-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:50rem;">
                    <i class="fas fs-2 fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">
                        {{ $notificationCount ?? 0 }}
                    </span>
                </a>    
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1" id="notificationDropdown">
                    @if(isset($notifications) && $notifications->isNotEmpty())
                        @foreach($notifications as $notification)
                            <li>
                                <a class="dropdown-item" href="#">
                                    {{ $notification->data['message'] ?? 'Notification sans message' }}
                                </a>
                            </li>
                        @endforeach
                        @else
                            <li>
                                <a class="dropdown-item" href="#">
                                    Aucune notification
                                </a>
                            </li>
                    @endif
                </ul>
            </div>

            <!-- Avatar -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right:11rem;">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('dist/image/' . Auth::user()->gender . '.png') }}" class="rounded-circle" style="width:30px; height:40px; border-raduis:20px;" alt="Avatar">
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{route('Auth-LoginGetShow')}}">Mot de Passe</a></li>
                    <li><a class="dropdown-item" href="{{route('Admin-ProfileGetShow')}}">Profil</a></li>
                        <hr class="dropdown-divider-white">
                    </li>
                    <li>
                        <form action="{{route('postLogout')}}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                Se deconnecter
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            </ul>
        </div>
    <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>