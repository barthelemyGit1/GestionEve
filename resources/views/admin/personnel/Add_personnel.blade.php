@extends('layouts.admin')

@section('content')
    
    @if(session('success'))
   <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
 @endif


 <form action="{{ route('personnel.store') }}" method="POST" enctype="multipart/form-data">
    @csrf {{csrf_field()}}
    <fieldset style=" font-size:40px; color:blue; margin-left:100px ; margin-top:30px"><h1>AJOUTER DU PERSONNEL</h1></fieldset>
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger 630" style="width: 600px; margin-left:35px"> {{ $err}}</p>
    @endforeach
    @endif
  <div class="form-floating mb-3 float-none " style="margin:35px; margin-top:5px; width:600px; border: solid 1px blue; border-radius:15px" >
   
  <!--  <div class="col-md m-2" >
       <div class="form-floating">
          <select  name="mode" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
             <option selected>choisir</option>
             <option value="Ran coupée">Avance et retenue directe</option>
             <option value="Ordinaire">Retenue directe</option>
            </select>
            <label for="floatingSelectGrid">MODE</label>
        </div>
    </div> -->
  <div class="col-md m-2">
    <div class="form-floating">
      <input type="texte" class="form-control" name="nom" id="floatingInputGrid" placeholder="NOM ET PRENOM" value="">
      <label for="floatingInputGrid">NOM ET PRENOM</label>
    </div>
  </div>

  <div class="col-md m-2">
    <div class="form-floating">
      <input type="texte" class="form-control" name="matr" id="floatingInputGrid" placeholder="Matricule" value="">
      <label for="floatingInputGrid">Matricule</label>
    </div>
  </div>

  <div class="col-md m-2">
    <div class="form-floating">
      <input type="email" class="form-control" name="nom" id="floatingInputGrid" placeholder="Email" value="">
      <label for="floatingInputGrid">Email</label>
    </div>
  </div>

    <div class="col-md m-2">
       <div class="form-floating">
          <select  name="service" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
             <option selected>choisir</option>
             <option value="enseignant">UNB</option>
             <option value="secretaire">CHUSS</option>
             <option value="surveillant">ENSP</option>           
            </select>
            <label for="floatingSelectGrid">Service</label>
        </div>
    </div>

    
    <div class="col-md m-2">
    <div class="form-floating">
      <input type="texte" class="form-control" name="tel" id="floatingInputGrid" placeholder="TELEPHONE" value="">
      <label for="floatingInputGrid">TELEPHONE</label>
    </div>
  </div>
  <div class="col-md m-2">
    <div class="form-floating">
      <input type="texte" class="form-control" name="cnib" id="floatingInputGrid" placeholder="NUMERO DE PIECE" value="">
      <label for="floatingInputGrid">NUMERO DE PIECE</label>
    </div>
  </div>

    <div class="col-md m-2">
    <div class="form-floating">
      <input type="date" class="form-control" name="dateNaiss" id="floatingInputGrid" placeholder="DATE DE NAISSANCE" value="">
      <label for="floatingInputGrid">DATE DE NAISSANCE</label>
    </div>
  </div>
   
  <div class="col-md m-2">
    <div class="form-floating">
      <input type="integer" class="form-control" name="salaire" id="floatingInputGrid" placeholder="Salaire" value="">
      <label for="floatingInputGrid">Salaire</label>
    </div>
  </div>

   <button type="submit" value="submit" class="btn btn-primary " style="float:right ; margin-top:20px">Ajouter</button>
</form>
</div>

@endsection