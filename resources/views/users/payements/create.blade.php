@extends('layouts.appp')
@section('content')
                @push('script')
    <script type="text/javascript">
       //document.getElementById('datePaySite').setAttribute('min',new Date().toISOString().split('T')[0]);
       datePaySite.max = new Date().toISOString().split("T")[0];
    </script>
@endpush
<div class="card">
<div class="">
 <a class="btn btn-danger float-end" style="margin:0px" onclick="retourner()">Retour</a>
 </div>
    <div class="card-header" style="height:45px;"><h1 class="float-none " style="margin-left:300px;margin-top:-10px"><b>Souscripteur</b></h1>
    </div>
        <table class="table table-striped" >  
            <thead >   
                <tr>

                    <th><b>Nom et prenom:</b> {{$person->nom}}</th>
                    <th><b>Date de naissance :</b>{{$person->dateNaiss}} </th>
                </tr>
                <tr>
                    <th><b><h5>Numero telephone:</b>{{$person->tel}}</th>
                    <th><b>Numero cnib/passport :</b>{{$person->cnib}}</th>
                    <th><b>Service à:</b>{{$person->service}}</th>
                </tr>
            </thead>
        </table>  
</div>
<br>
 <div class="card">
 <div class="card-header" style="height:45px;" ><h1 class="float-none " style="margin-left:300px;margin-top:-10px"><b>Versement</b></h1>
 </div>
    <form  action ="{{ url('users/payements/store')}}" method="POST" enctype="multipart/form-data" style="padding:5px">
        @csrf
        <div class="row">
            <div class="col-6">
                <label>Nom prenom du souscripteur</label>
                <select name="personnel_id" class="form-control">
                    <option value="{{$person->id}}">{{$person->nom}}</option>
                </select>
            </div>
            <div class="col-6">
                <label>N° Souscription</label>
                <input type="text" name="souscription_id" class="form-control" placeholder="N°{{$sous->id}}" value="{{$sous->id}}"/>
            </div>
            @error('souscription_id')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="col-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="{{$sous->email}}" value="{{$sous->email}}"/>
            </div>
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror    
            <div class="col-6">
                <label>Numéro Du Reçu</label>
                <input type="number" name="numrecu" class="form-control" value=""/>
            
                @error('numrecu')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-6">
                <label>Montant Du Versement</label>
                <input type="number" name="montant" class="form-control"/>
                @error('montant')
                    <small class="text-danger">{{$message}}</small>
                @enderror   
            </div>
             
            <div class="col-6">
                <label>Date de payement</label>
                <input type="date" name="dateBanq"  class="form-control" max="2027-12-30" min="2020-01-01" aria-label="..."/>
                @error('dateBanq')
                    <small class="text-danger">{{$message}}</small>
                @enderror   
            </diV> 

            <div class="mb-3">
                <label>Photo du recu sous forme d'image</label>
                <input type="file" name="image" class="form-control-file mt-2" id="exampleFormControlFile1" required />
                @error('image')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="">
                <br>
                <button  class="btn btn-primary float-end" style="margin:8px">Ajouter</button>
            </div>
        </div>
    </form></div>
            </div>
        </div>
    </div>
</div>

<script>
     function retourner() {
          window.history.back()
       }
       </script>
@endsection


