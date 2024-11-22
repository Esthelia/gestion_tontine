{{-- @extends('layout.master')

@section('content')











    <div style="margin-top:8rem; margin-left:20rem;">
        <i class="fa-solid fs-1 fa-piggy-bank"></i>
        <span class="display-5 fw-bold"> Gestion Liste de Paiement</span><br>
        <small style="margin-left:3rem;">Listes des Paiement enregistrés</small>
        <br><br>
          <!-- Breadcrumb -->
          <nav class="d-flex">
            <h6 class="mb-0">
              <a href="" class="text-reset">Administrateur</a>
                <span>/</span>
                  <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
                    <span>/</span>
                  <a href="{{route('Admin-ContributionGetShow')}}" class="text-reset active"><u>Tontine</u></a>
                  <span>/</span>
                  <a href="{{route('Admin-PayementGetShow')}}" class="text-reset active"><u>Gestion Paiement</u></a><span>/</span>
                  <span>/</span>
                  <a href="{{route('Admin-VersementGetShow')}}" class="text-reset active"><u>Gestion de Versement</u></a>
            </h6>
          </nav>
          <br>
      <hr>
      <div class="text-end">
        <a href="{{ route('Admin-ContributionGetShow') }}" class="badge bg-danger text-white">
            Enregistrer un paiement
        </a>
    </div>
   <br><br>

   
  @if(session('success'))
   <div data-mdb-alert-init class="alert fade"   id="alert-success" role="alert" data-mdb-color="success" data-mdb-position="top-right" data-mdb-stacking="true" data-mdb-width="535px" data-mdb-append-to-body="true"  data-mdb-hidden="true" data-mdb-autohide="true" data-mdb-delay="2000">
    <a href="#" data-mdb-alert-init class="alert-link">
       {{ session('success') }}
    </a>   
   </div>
  @endif

  @if($errors->any())
   <div  data-mdb-alert-init class="alert fade" id="alert-danger" role="alert"  data-mdb-color="danger" data-mdb-position="top-right"  data-mdb-stacking="true" data-mdb-width="535px" data-mdb-append-to-body="true"  data-mdb-hidden="true" data-mdb-autohide="true" data-mdb-delay="2000">
    <a href="#" data-mdb-alert-init class="alert-link">
       @foreach($errors->all() as $error)
           {{ $error }}<br>
       @endforeach
    </a>   
   </div>
  @endif



  <table class="table table-bordered border-dark">
      <thead class="table-dark">
        <tr>
          <th scope="col">Membre</th>
          <th scope="col">Libellé Tontine</th>
          <th scope="col">Montant de La Cotisation</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($payements as $payement)
        <tr>
            <td>{{ $payement->member->fullname }}</td>
            <td>{{ $payement->contribution->wording }}</td>
            <td>{{ $payement->contribution->sum }}</td>
            <td>
                @php
                    $versement = $payement->versements()->where('user_id', Auth::id())->first();
                @endphp

                @if($versement)
                    @php
                        $amountPaid = (float) $versement->amount;
                        $totalContribution = (float) $payement->contribution->sum;
                        $remainingAmount = $totalContribution - $amountPaid;
                    @endphp

                    @if($amountPaid >= $totalContribution)
                        <span class="text-danger">&#10003; Payé</span> 
                    @else
                        <span class="text-danger">Montant restant: {{ number_format($remainingAmount, 2) }}</span>
                        <form action="{{ route('Admin-VersementPostComplete', ['id' => $versement->id]) }}" method="POST">
                          @csrf
                          
                            <label class="form-label" for="Amount_required">Entrez Montant</label>
                            <input type="text" id="remaining_amount" name="remaining_amount" class="form-control" placeholder="Entrez le montant required pour obtenir la cotisation total" required>
                          <button type="submit" class="text-sucess btn btn-outline-success mt-2">Solder</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('Admin-VersementGetCreate', $payement->id) }}" 
                      class="text-dark btn btn-outline-secondary">Versements</a>
                @endif
                  <a href="#" class="text-dark btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-trash-can"></i>
                  </a>
                
                  
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Êtes-vous sûr de vouloir supprimer cet élément ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                          <a href="{{ route('Admin-PayementPostDestroy', $payement->id) }}" class="btn btn-primary">Confirmer</a>
                        </div>
                      </div>
                    </div>
                  </div>
            </td>
        </tr>
      @endforeach
      </tbody>
  </table>







  <script>
    const triggers = [
    'primary',
    'secondary',
    'success',
    'danger',
    'warning',
    'info',
    'light',
    'dark',
  ];
  const basicInstances = [
    'alert-primary',
    'alert-secondary',
    'alert-success',
    'alert-danger',
    'alert-warning',
    'alert-info',
    'alert-light',
    'alert-dark',
  ];

  triggers.forEach((trigger, index) => {
    let basicInstance = mdb.Alert.getInstance(document.getElementById(basicInstances[index]));
    document.getElementById(trigger).addEventListener('click', () => {
      basicInstance.show();
    });
  });
  </script>














@endsection --}}



@extends('layout.master')

@section('content')

<div style="margin-top:8rem; margin-left:20rem;">
    <i class="fa-solid fs-1 fa-piggy-bank"></i>
    <span class="display-5 fw-bold"> Gestion Liste de Paiement</span><br>
    <small style="margin-left:3rem;">Listes des Paiement enregistrés</small>
    <br><br>
    <!-- Breadcrumb -->
    <nav class="d-flex">
        <h6 class="mb-0">
            <a href="{{route('Admin-ReceptionGetShow')}}" class="text-reset">Reception de la Somme à Recuperer</a>
            <span>/</span>
            <a href="{{ route('Admin-DashboardGetShow') }}" class="text-reset">Tableau de Bord</a>
            <span>/</span>
            <a href="{{ route('Admin-ContributionGetShow') }}" class="text-reset active"><u>Tontine</u></a>
            <span>/</span>
            <a href="{{ route('Admin-PayementGetShow') }}" class="text-reset active"><u>Gestion Paiement</u></a>
            <span>/</span>
            <a href="{{ route('Admin-VersementGetShow') }}" class="text-reset active"><u>Gestion de Versement</u></a>
        </h6>
    </nav>
    <br>
    <hr>
    <div class="text-end">
        <a href="{{ route('Admin-ContributionGetShow') }}" class="badge bg-danger text-white">
            Enregistrer un paiement
        </a>
    </div>
    <br><br>

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

    {{-- <table class="table table-bordered border-dark">
        <thead class="table-dark">
            <tr>
                <th scope="col">Membre</th>
                <th scope="col">Libellé Tontine</th>
                <th scope="col">Montant de La Cotisation</th>
                <th scope="col">Nombre du Montant Cotisé</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payements as $payement)
                <tr>
                    <td>{{ $payement->member->fullname ?? 'Membre suprimée' }}</td>
                    <td>{{ $payement->contribution->wording ?? 'Libellé supprimée' }}</td>
                    <td>{{ $payement->contribution->sum ?? 'Somme supprimée' }}</td>
                    <td>{{ $payement->quantity ?? 'Somme supprimée' }}</td>
                    <td>
                        @php
                            $versement = $payement->versements()->where('user_id', Auth::id())->first();
                        @endphp

                        @if($versement)
                            

                            @php
                                $amountPaid = (float) $versement->amount ?? 0;
                                $totalContribution = $payement->contribution ? (float) $payement->contribution->sum : 0;

                                if ($payement->contribution) {
                                    $remainingAmount = $totalContribution - $amountPaid;
                                } else {
                                    // Message par défaut si la contribution est null
                                    echo '<span class="text-danger">Contribution non trouvée</span>';
                                }
                            @endphp

                            @if($amountPaid >= $totalContribution)
                                <span class="text-success">&#10003; Payé</span> <!-- Coche verte -->
                            @else
                                <span class="text-danger">Montant restant: {{ number_format($remainingAmount, 2) }}</span>
                                <form action="{{ route('Admin-VersementPostComplete', ['id' => $versement->id]) }}" method="POST">
                                    @csrf
                                    <label class="form-label" for="remaining_amount">Entrez Le Montant Restant :</label>
                                    <input type="text" id="remaining_amount" name="remaining_amount" class="form-control @error('remaining_amount') is-invalid @enderror" placeholder="Entrez le montant required pour obtenir la cotisation totale" value="{{ old('remaining_amount') }}" required>
                                    
                                    @error('remaining_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                
                                    <button type="submit" class="btn btn-outline-success mt-2">Solder</button>
                                </form>
                                
                            @endif
                        @else
                            <a href="{{ route('Admin-VersementGetCreate', $payement->id) }}" 
                              class="text-dark btn btn-outline-secondary">Versements</a>
                        @endif

                        <!-- Modal de Suppression -->
                        <form action="{{ route('Admin-PayementPostDestroy', $payement->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-dark btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $payement->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{ $payement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $payement->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $payement->id }}">Confirmation de suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Êtes-vous sûr de vouloir supprimer ce paiement ? Il est actuellement enregistré dans les versements et sa suppression pourrait 
                                          affecter le suivi des tontines. Cliquez sur "Confirmer" pour supprimer ou sur "Annuler" pour annuler l'action.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-danger">Confirmer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}




    <table class="table table-bordered border-dark">
        <thead class="table-dark">
            <tr>
                <th scope="col">Membre</th>
                <th scope="col">Libellé Tontine</th>
                <th scope="col">Montant de La Cotisation</th>
                <th scope="col">Nombre du Montant Cotisé</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payements as $payement)
                <tr>
                    <td>{{ $payement->member->fullname ?? 'Membre supprimé' }}</td>
                    <td>{{ $payement->contribution->wording ?? 'Libellé supprimé' }}</td>
                    <td>{{ $payement->contribution->sum ?? 'Somme supprimée' }}</td>
                    <td>
                        @php
                            $quantity = $payement->quantity ?? 0;
                            $contributionSum = $payement->contribution->sum ?? 0;
                            $total = $quantity * $contributionSum;
                        @endphp
                        {{ number_format($total, 2) }} <!-- Affiche le total formaté -->
                    </td>
                    <td>
                        @php
                            $versement = $payement->versements()->where('user_id', Auth::id())->first();
                        @endphp
    
                        @if($versement)
                            @php
                                $amountPaid = (float) $versement->amount ?? 0;
                                $totalContribution = $payement->contribution ? (float) $payement->contribution->sum : 0;
    
                                if ($payement->contribution) {
                                    $remainingAmount = $totalContribution - $amountPaid;
                                } else {
                                    // Message par défaut si la contribution est null
                                    echo '<span class="text-danger">Contribution non trouvée</span>';
                                }
                            @endphp
    
                            @if($amountPaid >= $totalContribution)
                                <span class="text-success">&#10003; Payé</span> <!-- Coche verte -->
                            @else
                                <span class="text-danger">Montant restant: {{ number_format($remainingAmount, 2) }}</span>
                                <form action="{{ route('Admin-VersementPostComplete', ['id' => $versement->id]) }}" method="POST">
                                    @csrf
                                    <label class="form-label" for="remaining_amount">Entrez Le Montant Restant :</label>
                                    <input type="text" id="remaining_amount" name="remaining_amount" class="form-control @error('remaining_amount') is-invalid @enderror" placeholder="Entrez le montant requis pour obtenir la cotisation totale" value="{{ old('remaining_amount') }}" required>
                                    
                                    @error('remaining_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                
                                    <button type="submit" class="btn btn-outline-success mt-2">Solder</button>
                                </form>
                                
                            @endif
                        @else
                            <a href="{{ route('Admin-VersementGetCreate', $payement->id) }}" 
                              class="text-dark btn btn-outline-secondary">Versements</a>
                        @endif
    
                        <!-- Modal de Suppression -->
                        <form action="{{ route('Admin-PayementPostDestroy', $payement->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-dark btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $payement->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
    
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{ $payement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $payement->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $payement->id }}">Confirmation de suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer ce paiement ? Il est actuellement enregistré dans les versements et sa suppression pourrait 
                                            affecter le suivi des tontines. Cliquez sur "Confirmer" pour supprimer ou sur "Annuler" pour annuler l'action.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-danger">Confirmer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    



    

    <script>
        // Simplifiez le code JavaScript pour les alertes
        const alertSuccess = document.getElementById('alert-success');
        const alertDanger = document.getElementById('alert-danger');

        if (alertSuccess) {
            alertSuccess.classList.remove('fade');
            alertSuccess.classList.remove('d-none');
            setTimeout(() => {
                alertSuccess.classList.add('fade');
                alertSuccess.classList.add('d-none');
            }, 2000);
        }

        if (alertDanger) {
            alertDanger.classList.remove('fade');
            alertDanger.classList.remove('d-none');
            setTimeout(() => {
                alertDanger.classList.add('fade');
                alertDanger.classList.add('d-none');
            }, 2000);
        }
    </script>

@endsection