@extends('layouts.appp')
@section('content')
@forelse($souscription as $s)

<!--******* Users List payement *****-->

 <?php  $etat=($s->montantPayé*100)/$s->montantTotal; ?>
    <div class="container-md-12">
    <div class="card">
        <div class="card-header">
            <h3>Etat Du Contrat</h3>
        </div>
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
<div class="card">
            <div class="card-header">
                <table class="">
                    <th>
                        <h3>Montant du contrat <b>{{$s->montantTotal}} F CFA </b></h3>
                    </th>

                    <th>
                        <h3>Montant Payé:<b>{{$s->montantPayé}} F CFA ({{$etat}}%)</b></h3>
                    </th>
                    <th>
                        <h3>Restant à Payer :<b>{{$s->montantRestant}} F CFA</b></h3>
                    </th>
                </table>
            </div>
</div></div></div>

<br>
<table class="table table-striped" > 
<div class="card" style="overflow: auto;">
    <h5 style="margin-bottom: 2px;"> Vos Paiements
<a class="btn btn-primary float-end" Style="margin:5px" href="{{ url ('users/payements/create', $s) }}">Ajouter</a>
    </h5></div>

        <thead>   
            <tr>
                <th><b>N°</b></th>
                <th><b>N° Souscription</b></th>
                <th><b>N°Versement</b></th>
                <th><b>Numero Reçu</b></th>
                <th><b>Montant Versement</b></th>
                <th><b>Payé Le</b></th>
                <th><b>Enregistré Le</b></th>
                <th><b>Enregistré Par</b></th>
                @if($s->modePayement=='apport personnel')
                <th><b>Image Reçu</b></th>
                <th><b>Statut</b></th>
                <th><b>Actions</b></th>
                @endif
            </tr>

            <?php

        $p=App\Models\Users\Payement::where('souscription_id',$s->id)->get() ;$n=1?>
        </thead>
        <tbody> 
    @if($p)
        @forelse($p as $p)
            <tr>
                  <td>{{$n++}}</td>
                  <td>{{$p->souscription_id}}</td>
                  <td>{{$p->id}}</td>
                  <td>{{$p->numeroRecu}}</td>
                  <td>{{$p->montant}}</td>
                  <td>{{$p->datePayBanq}}</td>
                  <td>{{$p->created_at->format('d-m-y')}}</td>
                  @if($p->user_id != null)
                      <td>{{$p->user->name}}</td>
                    @else
                     <td>Admin</td>
                 @endif
                 <td><image height="50px" src="{{asset('/uploads/'.$p->image)}}" /></td>
                 @if($p->statut=='Validé')
                 <td style="color:#0052D5;">{{$p->statut}}</td>
                 @else
                 <td style="color:#F9BE5A;">{{$p->statut}}</td>
                 @endif
                 <td><a class="btn btn-sm btn-warning" href="{{route('voirpaie', $p)}}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                 <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                 <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>
                 </a></td>
                 


                </tr>
                @empty
                <tr>
                    <td colspan="7">Aucun Paiement Effectue</td>
                </tr>
         @endforelse
         
         
        
                
             
    @else
                  <tr>
                <td colspan="7">Aucun payement retrouvé pour l'instant</td>
            </tr>
    @endif
        </tbody> 
</table>

@empty
<div class="card">
    <div class="card-body">Vous n'avez pas de contrat</div>
</div>
@endforelse


<div class="card-footer">
    <div class="float-left">
      {{ $souscription->links() }}
    </div>
  </div>

@endsection
