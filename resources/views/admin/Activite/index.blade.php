@extends(auth()->user()->role_as==1 ? "layouts.admin" : "layouts.appp")
@section('content')

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
        <h5 class="modal-title" id="Title" style="color:blue"><b>Ajout d'Evenement</b></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('activitetype')}}" method="POST" class="col">
            @csrf {{csrf_field()}}
        <input type="text" name="type" class="form-control" id="type"  style="margin-bottom:20px"placeholder="type de l'activite" required/>
      <input  type="number" class="form-control" name="caracteristique" id="caracteristique" placeholder="Nombres de champs caracteristiques" required/>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
       <button class="btn btn-primary btn-lg text-white float-end"  >Ajouter</button>
       </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal saisi info d'ajout -->    
<div class="modal fade" id="saisinfos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SAISISSEZ LES CHAMPS</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
         
  <h3>Liste des activités
    @if (auth()->user()->role_as==1)
    <button class="btn btn-primary btn-lg text-white float-end" data-bs-toggle="modal" data-bs-target="#activitetype" data-backdrop="false">
      Ajouter
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg>
    </button>
    @endif
  </h3>
  </div>

  <div class="card-body">
         <div class="card-header">
          <form class="row row-cols-auto g-1">
            <div class="col">
      <label for="floatingSelectGrid" style="color:#ff7f27" >Critère De Recherche</label>
          <select  name="critere" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" placeholder="criter" >
             <option value="type_activite"> Type Evenement</option>
             <option value="items">Items </option>
             <option value="id">Id</option>
           </select>
        </div>
          <div class="col" style="padding-top:21px; margin-left:25px">
            <input class="form-control" type="text" name="q" value="{{$q}}" placeholder="Rechercher..." />	
          </div>
          <div class="col" style="padding-top:21px; margin-left:15px">
            <button class="btn btn-success">Rechercher</button>	
          </div>
        </form>
      </div>
</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr >
                            <th><b>TYPE Evenement</b></th>
                            <th><b>ITEMS</b> </th>
                            <th><b>ACTIONS</b></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr> 
                          @forelse($actitypes as $actityp)     
                              <td>{{ strtoupper($actityp->type_activite)}}</td> </a>
                              <td>{{$actityp->items}}</td></a>     
                                <td>
                                 <!--  <a class="btn btn-sm btn-warning float-end" href="{{route('Activite.edit',$actityp->id)}}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg></a> -->
                                    @if(Auth::user()->role_as == '1')
                                    <form action="{{route('Activite.destroy',$actityp)}}"  method="POST"  style="display:inline;" onsubmit="return confirm('Etes-vous sur de vouloir supprimer le activite?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger float-end" style="margin-left: 10px; margin-right:10px ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>
                                        </button>
                                        </form>
                                        @endif
                                        <a class="btn btn-sm btn-warning float-end" href="{{route('routeactidetail',$actityp->id)}}" >VOIR</a>
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
      {{ $actitypes->links() }}
    </div>
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
 @endsection
       