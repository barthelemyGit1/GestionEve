@extends('layouts.appp')

@section('content')

<div class="float-none mt-2 mb-2">    
  <fieldset style="font-size:40px; color:blue; margin-left:100px ; margin-top:30px; text-align:center"><h1>LISTE DES ACTIVITES DE TYPE {{strtoupper($type)}}</h1></fieldset>     
    </div>
    
    @if(session('success'))
   <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
 @endif
    <div wire:ignore.self class="modal fade " id="deleteS" tabindex="-1" aria-labelledby="deleteS" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Supprimer Une activité
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroySouscriptions()">
                    <div class="modal-body">
                        Etre vous sur de vouloir supprimer cette activité?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Oui, je supprime</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header"> 

            <!-- Modal Ajout -->
<div class="modal fade" id="activitetype" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Title" style="color:blue"><b>AJOUT D'ACTIVITE</b></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('activitetype')}}" method="POST" class="col">
            @csrf {{csrf_field()}}
        <input type="text" name="type" class="form-control" id="type"  style="margin-bottom:20px"placeholder="type de l'activite" required/>
        <input  type="number"name="caracteristique" class="form-control"  id="caracteristique" placeholder="Nombres de champs caracteristiques" required/>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="background-color:red">Annuler</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
       <button class="btn btn-primary btn-lg text-white float-end"  >Ajouter</button>
       </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal saisi info d'ajout -->     
<div class="modal fade" id="saisinfosprojet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:blue; text-align:center"><b>SAISISSEZ LES INFOMATIONS DU NOUVEAU PROJET</b></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('completer', $nombre)}}" method="POST" class="col" >
        @csrf {{csrf_field()}}
        @foreach($activitype as $activitype)
          <div class="form-group">
            <label for="recipient-name" class="col-form">TYPE ACTIVIITE</label>
            <input type="text" name="type"class="form-control" style="color:red;" value="{{strtoupper($activitype->type_activite)}}" />
              @for($i==0; $i<count($activitype->caracteristic);$i++)
                <label for="recipient-name" class="col-form">{{strtoupper($activitype->caracteristic[$i] )}}</label>
                <input type="{{$activitype->typedonne[$i]}}" name="donne.{{$i}}" class="form-control" placeholder="ENTREZ LE {{strtoupper($activitype->caracteristic[$i])}} DU PROJET"  required />
               @endfor
          @endforeach
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-primary">Enregistrer</button> 
         </form>
      </div>
    </div>
  </div>
</div>

<!-- ajout  participant -->
     <div class="modal fade" id="ajoutparticipant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN PARTICIPANT</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-control" action="{{route('adminparticip')}}" method="POST">
        @csrf {{csrf_field()}}
          <div class="form-group">
            <input type="text" name="acti_id" id="inp1" hidden >
          </div>
          <div class="form-group">
          <select name="participant" class="form-select" onchange="this.nextElementSibling.value=this.value"  required>
                                        <option value="">CHOISISSEZ LE PARTICIPANT</option>
                                         @foreach($personnel as $personnels)
                                        <option value="{{$personnels->id}}">{{$personnels->nom}}</option>
                                        @endforeach
                                    </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        <button  class="btn btn-primary">Ajouter</button>
      </div></form>
    </div>
  </div>
</div>
                  
                    Liste des activités 
                    <button class="btn btn-primary btn-lg text-white float-end" data-bs-toggle="modal" data-bs-target="#saisinfosprojet" data-backdrop="false">
                    Ajouter
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                </h3>
            </div>
           


            <?php  $n=1; ?>
            <div class="card-body">
                <table class="table table-bordered table-striped" style="overflow:auto;">
                    <thead>
                        <tr>
                            <th><b>N°</b></th>
                            <th><b>Id</b></th>
                            <th><b>Type Activite</b></th>
                            @foreach($activitypes as $activitypes)
                                @for($j==0; $j<count($activitypes->caracteristic);$j++)
                                  <th><b> {{ strtoupper($activitypes->caracteristic[$j] )}}</b></th>
                                @endfor
                            @endforeach
                            <th><b>PARTICIPANTS</b> </th>
                            <th><b>PUBLIE LE</b> </th>
                            <th><b>ACTIONS</b> </th>
                        </tr>
                    </thead>
                    <tbody>   
                                      
                      @forelse($actividetail as $actividetails)
                     
                      
                      <?php $tablong=count($actividetails->champvalues); $k=0; ?>
                        <tr>
                       
                         <td><b>{{$n++}}</b></td>
                         <td><b>{{$actividetails->id}}</b></td>
                      <td><b>{{$actividetails->type_activite}}</b></td>
                          @for($k==0;$k<=$tablong-1; $k++)
                          <td><b> {{ $actividetails->champvalues[$k] }}</b></td>
                            @endfor
                          <td><button class="btn btn-primary btn-sm text-white float-start" ><b>{{$actividetails->particitpants}}</b> Participants</button>
                        </td>
                          <td><b>{{$actividetails->created_at->format('d-m-y')}}</b></td>
                           <td>                          
                           <form method="POST" action="{{route('inscrit', $actividetails->id)}}"  onsubmit="return confirm('VOUS ETES SUR LE POINT DE DEMANDER UNE PARTICIPATION A CETTE ACTIVITE')">
                                        @csrf                                      
                                        <button class="btn btn-sm btn-success" style="margin-left: 10px; margin-right:10px ">Me participer                                            
                                        </button>
                         </form>
                         </td>
                         @endif


                        </tr>
                      @empty
                      <tr>
                      <td>Aucun enregistrement</td>
                      </tr>
                      @endforelse
                        
                    </tbody>
                </table> 
                
            </div>
        </div>
    </div>
</div>



<script>
     /*  $(document).on("click","#button2",function(){
        /* var monvar=$(this).data('acti');
        $("#inp1").val('bonjour');
        //var monvar2=document.createElement('value');
        //var monvar3 =document.getElementById("inp1").appendChild(monvar2);
                  //alert(monvar);*/
        
         function bonjour(y){
          var monvar=y;
        document.getElementById('inp1').value=monvar;

         }
      
    </script>
@push('script')
   <!--  <script>
       $(document).ready(function(){
        $(document).on("click",".open-modal",function(){
          var monvar='hello';//$(this).data('acti');
          $('#inp1').value=$monvar;
          console_log('hello');
        })
       })
    </script> -->
    
@endpush
@endsection