@if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
<div class="container-md-12">



<div class="modal fade" id="parcellelogement2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="Title" style="color:blue"><b>Ajout De Souscription</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <a class="md-5 mt-5 btn btn-primary mt-2 mt-xl-0 px-5" href="{{url('admin/souscriptions/createL')}}">Logement</a>
                      <a class="md-5 mt-5 btn btn-success mt-2 mt-xl-0 px-5 " href="{{url('admin/souscriptions/createP')}}">Parcelle</a>
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">Annuler</button>
                      </div>
                    </div>
                  </div>
                </div>


  <div class="card">
    <div class="card-header">
      <h3>
       
        
        <!-- <div class="card-body">
         <div class="card-header">
          <form class="row row-cols-auto g-1">
            <div class="col">
            <label for="floatingSelectGrid" style="color:#ff7f27" >CRITERE DE RECHERCHER</label>
              <select  name="critere" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" placeholder="criter" >
                  <option value="id">identifiant du contrat</option>
                  <option value="typeProduit">type de Produit </option>     
                  <option value="nom">Nom du souscripteur </option>                  
              </select>
              </div>
        <div class="col" style="padding-top:21px; margin-left:25px">
          <input class="form-control" type="text" name="q" value="" placeholder="Rechercher..." />	
        </div>
        
          <div class="col" style="padding-top:21px">
            <button class="btn btn-success">Rechercher</button>	
          </div>
          </div>
      </form>
    </div> -->

    <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" type ="button" role="tab" data-bs-target="#home-tab-pane" aria-controls="home-tab-pane" aria-selected="true" >
                    Contrat Comptant
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="seo-tab" data-bs-toggle="tab" type ="button" role="tab" data-bs-target="#seo-tab-pane" aria-controls="seo-tab-pane" aria-selected="false" >
                    Contrat Retenue Direct
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="seo-tab" data-bs-toggle="tab" type ="button" role="tab" data-bs-target="#images-tab-pane" aria-controls="seo-tab-pane" aria-selected="false" >
                    Contrat Apporte Personnel
                </button>
            </li>
        </ul>

        </h3>
    </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade border p-3 show-active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" >

                <div class="table-responsive">
                  Contract Comptant
            <table class="table table-bordered table-striped ">
              <thead class="">  
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Nom Prenom(s)</b></th>
                            <th><b>Date de debut</b></th>
                            <th><b>Date de fin</b></th>
                            <th><b>Montatnt total</b></th>
                            <th><b>Montatnt payé</b></th>
                            <th><b>Montatnt restant</b></th>
                            <th><b>Mode de payement</b></th>
                            <th><b>Sites</b></th>
                            <th><b>Logement</b></th>
                            <th><b>Superficie</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($souscriptions as $s)
                            @if($s->modePayement == 'comptant')
                             <tr>
                                <td> {{$s->id}} </td>
                                <?php    
                                    $pers = App\Models\Personnels::where('id',$s->personnel_id)->first();
                                ?>
                                @if($pers)
                                    <td> {{$pers->nom}} </td>
                                    <td> {{$s->dateDebut}} </td>
                                    <td> {{$s->dateFin}} </td>
                                    <td> {{$s->montantTotal}} </td>
                                    <td> {{$s->montantPayé}} </td>
                                    <td> {{$s->montantRestant}} </td>
                                    <td> {{$s->modePayement}} </td>
                                    <td> {{$s->site}} </td>
                                    <td> {{$s->typeLogement}} </td>
                                    <td> {{$s->superficieLogement}} </td>
                                    <td> <a class="btn btn-warning" href="{{ url('admin/souscriptions/'.$s->id.'/showcontrats')}}">Voir</a>
                                    </td>
                                @endif
                             @endif
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7">Pas de contrats pour l'instant</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>               
            </div>
        

    <div class="card-footer">
    <div class="float-left">
      {{ $souscriptions->links() }}
    </div>
  </div>

  </div>
<div class="tab-pane fade border p-3" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">

<div class="table-responsive">
  <h3>Contracts Retenue Direct</h3>
            <table class="table table-bordered table-striped ">
              <thead class="">  
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Nom Prenom(s)</b></th>
                            <th><b>Date de debut</b></th>
                            <th><b>Date de fin</b></th>
                            <th><b>Montatnt total</b></th>
                            <th><b>Montatnt payé</b></th>
                            <th><b>Montatnt restant</b></th>
                            <th><b>Mode de payement</b></th>
                            <th><b>Sites</b></th>
                            <th><b>Logement</b></th>
                            <th><b>Superficie</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($souscriptions as $s)
                        @if($s->modePayement == 'retenu direct')
                        
                            <tr>
                                <td> {{$s->id}} </td>
                                <?php    
                                    $pers = App\Models\Personnels::where('id',$s->personnel_id)->first();
                                ?>
                                @if($pers)
                                    <td> {{$pers->nom}} </td>
                                    <td> {{$s->dateDebut}} </td>
                                    <td> {{$s->dateFin}} </td>
                                    <td> {{$s->montantTotal}} </td>
                                    <td> {{$s->montantPayé}} </td>
                                    <td> {{$s->montantRestant}} </td>
                                    <td> {{$s->modePayement}} </td>
                                    <td> {{$s->site}} </td>
                                    <td> {{$s->typeLogement}} </td>
                                    <td> {{$s->superficieLogement}} </td>
                                    <td> <a class="btn btn-warning" href="{{ url('admin/souscriptions/'.$s->id.'/showcontrats')}}">Voir</a>
                                    </td>
                                @endif
                            </tr>
                            @endif

                        @empty
                            <tr>
                                <td colspan="7">Pas de contrats pour l'instant</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>               
            </div>
        
    <div class="card-footer">
    <div class="float-left">
      {{ $souscriptions->links() }}
    </div>
  </div>

  </div>
<div class="tab-pane fade border p-3" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab" tabindex="0">

<div class="table-responsive">
  <h3>Contracts Retenue Direct</h3>
            <table class="table table-bordered table-striped ">
              <thead class="">  
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Nom Prenom(s)</b></th>
                            <th><b>Date de debut</b></th>
                            <th><b>Date de fin</b></th>
                            <th><b>Montatnt total</b></th>
                            <th><b>Montatnt payé</b></th>
                            <th><b>Montatnt restant</b></th>
                            <th><b>Mode de payement</b></th>
                            <th><b>Sites</b></th>
                            <th><b>Logement</b></th>
                            <th><b>Superficie</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($souscriptions as $s)
                          @if($s->modePayement =='apport personnel')
                            <tr>
                                <td> {{$s->id}} </td>
                                <?php    
                                    $pers = App\Models\Personnels::where('id',$s->personnel_id)->first();
                                ?>
                                @if($pers)
                                    <td> {{$pers->nom}} </td>
                                    <td> {{$s->dateDebut}} </td>
                                    <td> {{$s->dateFin}} </td>
                                    <td> {{$s->montantTotal}} </td>
                                    <td> {{$s->montantPayé}} </td>
                                    <td> {{$s->montantRestant}} </td>
                                    <td> {{$s->modePayement}} </td>
                                    <td> {{$s->site}} </td>
                                    <td> {{$s->typeLogement}} </td>
                                    <td> {{$s->superficieLogement}} </td>
                                    <td> <a class="btn btn-warning" href="{{ url('admin/souscriptions/'.$s->id.'/showcontrats')}}">Voir</a>
                                    </td>
                                @endif
                            </tr>
                            @endif

                        @empty
                            <tr>
                                <td colspan="7">Pas de contrats pour l'instant</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>               
            </div>
       

    <div class="card-footer">
    <div class="float-left">
      {{ $souscriptions->links() }}
    </div>
  </div>
  </div>


</div>
</div>
</div>



