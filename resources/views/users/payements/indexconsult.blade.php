@extends('layouts.admin')
@section('content')
@if(session('success'))
        <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
    @endif
<div class="float-none mt-2 mb-2">    
  <div class="container-md-12">
  <div class="card">
    <div class="card-header">
        <h3>Versements</h3>    
 </div> 
    <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
            <tr>
                <th><b>Nom et prenom(s)</b></th>
                <th><b>Telephone</b></th>
                <th><b>CNIB/Passport</b></th>
                <th><b>Actions</b></th>
            </tr>
        </thead>
        <tbody> 
        
            @foreach ($souscription as $s)
                <tr>
                    <?php    
                        $pers = App\Models\Personnels::where('id',$s->personnel_id)->first();
                    ?>
                    <td>{{$pers->nom}}</td>
                    <td>{{$pers->tel}}</td>
                    <td>{{$pers->cnib}}</td>
                    
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ route('consulterV.show',$s->id)}}">Consulter
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                        </a>
                        @if($s->montantPayé >= $s->montantTotal)
                        <button class="btn btn-sm btn-primary" >Contrat Terminé</button>
                        @else
                        <a class="btn btn-sm btn-primary" href="{{ route('Paiement.show',$s->id)}}">Ajouter
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody> 
</table>
 <div class="card-footer">
    <div class="float-left">
      {{ $souscription->links() }}
    </div>
  </div>  
</div>
@endsection