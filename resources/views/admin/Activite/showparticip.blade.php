@extends(auth()->user()->role_as==1 ? "layouts.admin" : "layouts.appp")
@section('content')
<div class="float-none mt-2 mb-2">    
  <fieldset style="font-size:40px; color:blue; margin-left:100px ; margin-top:30px; text-align:center"><h1>Les Personnes Interessés aux activités</h1></fieldset>     
    </div>  
    @if(session('success'))
   <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
 @endif

 
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" type ="button" role="tab" data-bs-target="#home-tab-pane" aria-controls="home-tab-pane" aria-selected="true" >
                  Les Participants
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="seo-tab" data-bs-toggle="tab" type ="button" role="tab" data-bs-target="#seo-tab-pane" aria-controls="seo-tab-pane" aria-selected="false" >
                    Les Demandes en Cours
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade border p-3 show-active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" >


        <div class="card">
            <div class="card-header">   
                    <h3>Les Participants A Cet Activite
                    <!-- <button class="btn btn-primary btn-lg text-white float-end" data-bs-toggle="modal" data-bs-target="#activitetype" data-backdrop="false">
                    Ajouter
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button> -->
                </h3>
            </div>
           
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Id</th>
                            <th>Nom Et Prenom</th>
                            <th>Prefession</th>
                            <th>Telephone</th>
                            <th>Cnib</th>
                            <th>Date De Naissance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> <?php $no=1; ?>
                        @forelse($nombreparticip as $particip)
                             <tr>
                                <td>{{$no++}}</td>
                                <td>{{$particip->personnel->id}}</td>
                                <td>{{$particip->personnel->nom}}</td>
                                <td>{{$particip->personnel->service}}</td>
                                <td>{{$particip->personnel->tel}}</td>
                                <td>{{$particip->personnel->cnib }}</td>
                                <td>{{$particip->personnel->dateNaiss }}</td>                                                                            
                                <td>   <form action="{{route('inscritActivite.destroy',$particip)}}"  method="POST"  style="display:inline;" onsubmit="return confirm('Etes-Vous Sûr De Vouloir Detâcher Ce Personnel De Cet Activite ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger float-end" style="margin-left: 10px; margin-right:10px ">Retirer
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg> -->
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                             @empty
                            <tr>
                                <td colspan="7">Pas de particitpants pour l'instant</td>
                            </tr> 
                          @endforelse
                    </tbody>
                </table> 
            </div>
        </div>

<br><br>
            </div>
            <div class="tab-pane fade border p-3" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">


        <div class="card">
            <div class="card-header">   
                    <h3>Les Demandeés en Cours Pour Cet activité
                    <!-- <button class="btn btn-primary btn-lg text-white float-end" data-bs-toggle="modal" data-bs-target="#activitetype" data-backdrop="false">
                    Ajouter
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button> -->
                </h3>
            </div>
           
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Id</th>
                            <th>Nom Et Prenom</th>
                            <th>Prefession</th>
                            <th>Telephone</th>
                            <th>Cnib</th>
                            <th>Date De Naissance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> <?php $no=1; ?>
                        @forelse($nombrDemand as $demamd)
                             <tr>
                                <td>{{$no++}}</td>
                                <td>{{$demam->personnel->id}}</td>
                                <td>{{$demam->personnel->nom}}</td>
                                <td>{{$demam->personnel->service}}</td>
                                <td>{{$demam->personnel->tel}}</td>
                                <td>{{$demam->personnel->cnib }}</td>
                                <td>{{$demam->personnel->dateNaiss }}</td>                                                                            
                                <td>   <form action="{{route('inscritActivite.destroy',$demam)}}"  method="POST"  style="display:inline;" onsubmit="return confirm('Etes-vous sur de vouloir supprimer le activite?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger float-end" style="margin-left: 10px; margin-right:10px ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                             @empty
                            <tr>
                                <td colspan="7">Pas De Demande Pour En Cours L'Instant</td>
                            </tr> 
                          @endforelse
                    </tbody>
                </table> 
            </div>
            <div class="card-footer">
    <div class="float-left">
      {{ $nombrDemand->links() }}
    </div>
  </div>
</div>
        </div>
        </div>
  <div class="">
 <button class="btn btn-danger" style="margin:0px" onclick="retourner()">Retour</button>
 </div>

@push('script')
    <script>
       window.addEventListener('close-modal',event=> {
            $('#deleteS').modal('hide');
        });       
</script>
@endpush
<script>
function retourner() {
    
     window.history.back()
        }
</script>
 @endsection
       