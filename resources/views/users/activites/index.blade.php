@extends('layouts.appp')

@section('content')
    
    @if(session('success'))
   <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
 @endif
 <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>Liste des activités</h3>
          </div>
        
            <div class="container " style="margin-bottom: 1px;">
                 
                    <form class="row row-cols-auto g-1">

                  <div class="col">
                  <label for="floatingSelectGrid" style="color:#ff7f27" >Critère De Recherche</label>
                      <select  name="critere" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" placeholder="criter" >
                        <option value="type_activite"> Type Activite</option>
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
                  </div><br>
 
 <div>
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            
<!-- Modal Ajout -->
<div class="modal fade" id="activitetype" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <form action="{{ route('activitetype')}}" method="POST" class="col">
            @csrf {{csrf_field()}}
        <input type="text" name="type" class="form-control" id="type"  style="margin-bottom:20px"placeholder="type de l'activite" required/>
      <input  type="number" class="form-control" name="caracteristique" id="caracteristique" placeholder="Nombres de champs caracteristiques" required/>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
       
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
           
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr >
                            <th><b>TYPE ACTIVIITE</b></th>
                            <th><b>ITEMS</b> </th>
                            <th><b>ACTIONS</b></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr> 
                          @forelse($actitype as $actityp)     
                              <td>{{ strtoupper($actityp->type_activite)}}</td> </a>
                              <td>{{$actityp->items}}</td></a>     
                                <td>
                                 <!--  <a class="btn btn-sm btn-warning float-end" href="{{route('Activite.edit',$actityp->id)}}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg></a> -->
                                        <a class="btn btn-sm btn-warning float-end" href="{{url('actidetail/'.$actityp->id)}}" >VOIR</a>                                  
                                      
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
      {{ $actitype->links() }}
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