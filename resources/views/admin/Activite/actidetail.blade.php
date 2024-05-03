@extends(auth()->user()->role_as==1 ? "layouts.admin" : "layouts.appp")
@section('content')
    @if(session('success'))
       <p class="alert alert-success" id="script1" style="font-size:30px"> 
            {{ session('success') }}
        </p>
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
                                <h5 class="modal-title" id="Title" style="color:blue"><b>AJOUT D'Evenement</b></h5>
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
                            <h5 class="modal-title" id="exampleModalLabel" style="color:blue; text-align:center">
                                <b>SAISISSEZ LES INFOMATIONS DU NOUVEAU PROJET</b>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('completer', $nombre)}}" method="POST" class="col" >
                            @csrf {{csrf_field()}}
                            @foreach($activitype as $activitype)
                                <div class="form-group">
                                <label for="recipient-name" class="col-form">TYPE Evenement</label>
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
                  
                  <h3> Liste des Evenements
                    @if(auth()->user()->role_as==1)
                    <button class="btn btn-primary btn-lg text-white float-end" data-bs-toggle="modal" data-bs-target="#saisinfosprojet" data-backdrop="false">
                    Ajouter
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                    @endif
                </h3>
            </div>
           


            <?php  $n=1; ?>
            <div class="card-body">
              <table class="table table-bordered table-striped" style="overflow:auto;">
                <thead>
                  <tr>
                    <th>
                      <b>N°</b>
                    </th>
                    <th>
                      <b>Id</b>
                    </th>
                    <th>
                      <b>Type Evenement</b>
                    </th>
                    @foreach($activitypes as $activitypes)
                      @for($j==0; $j<count($activitypes->caracteristic);$j++)
                        <th>
                          <b> {{ strtoupper($activitypes->caracteristic[$j] )}}</b>
                        </th>
                      @endfor
                    @endforeach
                    <th>
                      <b>PARTICIPANTS</b>
                    </th>
                    <th>
                      <b>PUBLIE LE</b> 
                    </th>
                    <th>
                      <b>ACTIONS</b> 
                    </th>
                  </tr>
                </thead>
              <tbody>   
              @forelse($actividetails as $actividetails)
                <?php $tablong=count($actividetails->champvalues); $k=0; $particip=count(\App\Models\InscritActivite::where('activite_id',$actividetails->id)->get()) ?> 
                  <tr>
                    @if(auth()->user()->role_as=='1') 
                      <td>
                        {{$n++}}
                      </td>
                      <td>
                        <b>{{$actividetails->id}}</b>
                      </td>
                      <td>
                        <b>{{$actividetails->type_activite}}</b>
                      </td>                      
                        @for($k==0;$k<=$tablong-1; $k++)
                          <td>
                            <b> {{ $actividetails->champvalues[$k] }}</b>
                          </td>
                        @endfor
                        <td class="">
                          <button class="btn btn-warning btn-sm text-white float-start" style="font-size:15px">
                            <b>
                              {{$particip}}/
                              <a style="color:white; text-decoration:none; " href="{{route('Activite.show', $actividetails)}}">
                                Voir
                              </a>
                            </b>
                          </button>              
                          <br>
          
                          Limite atteinte  
                        </td>
                          <td><b>{{$actividetails->created_at->format('d-m-y')}}</b></td>
                            <td class="">
                              <a class="btn btn-sm btn-warning float-end" href="{{route('Activite.edit',$actividetails->id)}}" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
                              </a>
                            <form  action="{{route('routeremove',$actividetails)}}" method="POST" style="display:inline;" onsubmit="return confirm('Etes-vous sur de vouloir supprimer le activite?')">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger">   
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                              </button>       
                            </form>
                          </td>

                         
                          @for($k==0;$k<=$tablong-1; $k++)
                          <td><b> {{ $actividetails->champvalues[$k] }}</b></td>
                            @endfor
                            
                         
                            <?php $pers=\App\Models\Personnels::where('email', auth()->user()->email)->first();
                            if($pers){
                            $esist=\App\Models\InscritActivite::where('activite_id',$actividetails->id)->where('personnel_id',$pers->id) ;
                            }  ?>
                        @if($pers)
                            @if($esist==null)
                                                    
                           <form method="POST" action="{{route('inscrit', $actividetails->id)}}"  onsubmit="return confirm('VOUS ETES SUR LE POINT DE DEMANDER UNE PARTICIPATION A CETTE ACTIVITE')">
                                        @csrf                                      
                                        <button class="btn btn-sm btn-success" style="margin-left: 10px; margin-right:10px ">Me participer                                            
                                        </button>
                         </form>
                         </td>
                             @else
                             <button class="btn btn-sm btn-success" style="margin-left: 10px; margin-right:10px ">Inscrit                                            
                                        </button>
                              @endif
                          @else
                          
                          @endif                                          

                         @endif


                        </tr>
                      @empty
                      <tr>
                      <td>Aucun enregistrement</td>
                      </tr>
                      @endforelse
                        
                    </tbody>
                </table> 
                <div class="">
 <a class="btn btn-danger" style="margin:0px" onclick="retourner()">Retour</a>
 </div>
            </div>
        </div>
    </div>
    
</div>
</div>



<script>
     function retourner() {
          window.history.back()
       }

        
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
       