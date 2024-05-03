@extends('layouts.admin')
@section('content')
    
@if(session('success'))
  <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
@endif
<div class="container-md-12">
    
        <div class="card">
          <div class="card-header">
            <h3>Personnel de l'UNB
            <button class="btn btn-primary btn-lg text-white  float-end" data-bs-toggle="modal" data-bs-target="#ajoutpersonnel" data-backdrop="false" >Ajouter 
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                  </button>
            </h3>
          </div>
        <div class="card-body pt-2">
         <div class="card-header">
          <form class="row row-cols-auto g-1">
            <div class="col">
              <label for="floatingSelectGrid" style="color:#ff7f27" >CRITERE DE RECHERCHER</label>
                  <select  name="critere" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" placeholder="criter" >
                    <option selected>nom</option>
                    <option value="superficie">service</option>
                    <option value="superficieattribuee">telephone</option>
                    <option value="section">cnib</option>
                    <option value="lot">DateNaiss</option>
                    <option value="numvilla">age</option>
                  </select>
            </div>
            <div class="col" style="padding-top:21px; margin-left:25px">
              <input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Rechercher..." />	
            </div>
            <div class="col" style="padding-top:21px; margin-left:15px">
              <button class="btn btn-success">Rechercher</button>	
            </div>
          </div>
      </form>
    </div>
          </p>
           <!-- modal ajout  Personnel -->
     <div class="modal fade" id="ajoutpersonnel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Un Personnel</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-control" action="{{route('personnel.store')}}" method="POST">
        {{csrf_field()}}         
          <div class="form-group">
          <input type="texte" class="form-control" name="nom" id="floatingInputGrid" placeholder="NOM ET PRENOM" value="">
          </div>

          <div class="form-group">
          <input type="texte" class="form-control" name="matr" id="floatingInputGrid" placeholder="Matricule" value="">
          </div>

          <div class="form-group">
          <input type="email" class="form-control" name="email" id="floatingInputGrid" placeholder="Email" value="">
          </div>
          <div class="form-group">
          <select  name="service" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
             <option value="">choisir Service</option>
             <option value="enseignant">UNB</option>
             <option value="secretaire">CHUSS</option>
             <option value="surveillant">ENSP</option>           
            </select>          
          </div>
          <div class="form-group">
          <input type="texte" class="form-control " name="tel"  placeholder="Entrez Le Numero de Telephone" value="">
          </div>
          <div class="form-group">
          <input type="texte" class="form-control" name="cnib"  placeholder="NUMERO DE PIECE" placeholder="Entrez le numero de pièce">         
          </div>
          <div class="form-group">
          <label class="form-control-label mb-0">DATE DE NAISSANCE</label>
          <input type="date" class="form-control" name="dateNaiss" id="floatingInputGrid" placeholder="DATE DE NAISSANCE" value="">    
          </div>

          <div class="form-group">
    <div class="form-control-label mb-0">
      <input type="integer" class="form-control" name="salaire" id="floatingInputGrid" placeholder="Salaire" value="">
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        <button  class="btn btn-primary">Ajouter</button>
      </div></form>
    </div>
  </div>
</div>
          <div class="table-responsive ">
            <table class="table table-bordered table-striped">
              <thead class="">   
                <tr>
                    <th>N°</th>
                    <th> <b>Identifiant</b></th>
                    <th><b>NOM ET PRENOM</b></th>
                     <th><b>PROFESSION</b></th>
                    <th><b>TELEPHONE</b></th>
                    <th><b>CNIB</b></th>
                    <th><b>DATE NAISSANCE</b></th>
                    <th><b>Email</b></th>
                    <th><b>ACTIONS</b></th>   
                </tr>
        </thead>    
        <?php

use Illuminate\Support\Carbon;

 $no=1 ?>
   
    <tbody> 
          @foreach ($personnel as $pers)
          <tr>
                  <td  class="text-center print_ignore">
      <input type="checkbox" class="multi_checkbox checkall" id="id_rows_to_delete2_left" name="rows_to_delete[2]" value="`personnels`.`id` = 3">
      <input type="hidden" class="condition_array" value="{&quot;`personnels`.`id`&quot;:&quot;= 3&quot;}">
       </td>
                  <td>{{$no++}}</td>
                  <td>{{$pers->nom}}</td>
                  <td>{{$pers->service}}</td>
                  <td>{{$pers->tel}}</td>
                  <td>{{$pers->cnib }}</td>
                  <td>{{$pers->dateNaiss }}</td>
                  <td>{{$pers->email}}</td>
                  <td><a class="btn btn-sm btn-warning" href="{{ route('personnel.edit', $pers)}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                  </svg>
                  </a>
                  <form  action="{{ route('personnel.destroy',$pers)}}" method="POST" style="display:inline;" onsubmit="return confirm('Etes-vous sur de vouloir supprimer le Personnel?')">
                 @csrf
                 @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                  </svg>
                  </button>
                </form>
               </td>    
          </tr>
          @endforeach
    </tbody>  
     </table>
  </div>















  <div class="card-footer">
    <div class="float-left">
      {{ $personnel->links() }}
    </div>
  </div>
</div>
@endsection