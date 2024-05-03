<div>
    <div wire:ignore.self class="modal fade " id="deleteS" tabindex="-1" aria-labelledby="deleteS" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Supprimer Une souscription
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroySouscriptions()">
                    <div class="modal-body">
                        Etre vous sur de vouloir supprimer cette souscription?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Oui, je supprime</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>


    <div class="modal fade" id="parcellelogement3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="Title" style="color:blue"><b>Ajout De Souscription</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <a class="md-5 mt-5 btn btn-primary mt-2 mt-xl-0 px-5" href="{{url('admin/souscriptions/createL')}}" style="margin-right: 10px;">Logement</a>
                      <a class="md-5 mt-5 btn btn-success mt-2 mt-xl-0 px-5 " href="{{url('admin/souscriptions/createP')}}" style="margin-left: 10px;">Parcelle</a>
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">Annuler</button>
                      </div>
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
                <h3>
                    Liste des souscripts à l'immobilier
                    <button class="btn btn-primary btn-sm text-white float-end" data-bs-toggle="modal" data-bs-target="#parcellelogement3" data-backdrop="false" >
                        Ajouter
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                </h3>
            </div>
            <div class="card-body">
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
    </div>
            <div class="table-responsive">
            <table class="table table-bordered table-striped ">
              <thead class="">   
                        <tr >
                            <th><b>ID</b></th>
                            <th><b>Nom Prenom(s)</b> </th>
                            <th><b>Email</b></th>
                            <th><b>Dates naissances</b></th>
                            <th><b>Telephones</b></th>
                            <th><b>CNIB</b></th>
                            <th><b>Services</b></th>
                            <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($souscriptions as $s)
                       
                            <tr>
                                <td> {{$s->id}} </td>
                                <?php    
                                    $pers = App\Models\Personnels::where('id',$s->personnel_id)->first();
                                ?>
                                <td> {{$pers->nom}} </td>
                                <td> {{$pers->email}} </td>
                                <td> {{$pers->dateNaiss}} </td>
                                <td> {{$pers->tel}} </td>
                                <td> {{$pers->cnib}} </td>
                                <td> {{$pers->service}} </td>
                                <td>
                                    <a href="{{ url ('admin/souscriptions/'.$s->id.'/edit') }}" class="btn btn-sm btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </a>
                                    <a href="" wire:click="deleteSouscriptions({{$s->id}})" data-bs-toggle ="modal" data-bs-target="#deleteS" class="btn btn-sm btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7">Pas de produits pour l'instant</td>
                            </tr>
                       
                        @endforelse
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <div class="card-footer">
    <div class="float-left">
      {{ $souscriptions->links() }}
    </div>
  </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal',event=> {
            $('#deleteS').modal('hide');
        });
    </script>
@endpush
