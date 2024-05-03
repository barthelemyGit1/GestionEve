@extends('layouts.appp')
@section('content')
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
        <thead>   
            <tr>
                <th><b>N°</b></th>
                <th><b>N°Versement</b></th>
                <th><b>Id souscription</b></th>
                <th><b>N°Reçu</b></th>
                <th><b>Montant Versement</b></th>
                <th><b>Payé Le</b></th>
                <th><b>Enregistré Le</b></th>
                <th><b>Enregistré Par</b></th>
                <th><b>Image Reçu</b></th>
                <th><b>Statut</b></th>
            </tr>
        </thead>
        <tbody> 

     @if($ps)<?php $n=1?>
        @forelse($ps as $p)
            <tr>
                  <td>{{$n++}}</td>
                  <td>{{$p->id}}</td>
                  <td>{{$p->souscription_id}}</td>
                  <td>{{$p->numeroRecu}}</td>
                  <td>{{$p->montant}}</td>
                  <td>{{$p->datePayBanq}}</td>
                  <td>{{$p->created_at->format('d-m-y')}}</td>
                  @if($p->user_id != null)
                  <td><image height="100px" src="{{asset('/uploads/'.$p->image)}}" /></td>
                    @else
                     <td>Admin</td>
                 @endif
                 <th>{{$p->image}}</th>
                 @if ($p->statut !== 'En cours...')
                        <td style="color:blue">{{$p->statut}}</td>
                            @else
                        <td style="color:#ff7f27"> {{$p->statut}}</td>
                        @endif
                </tr>
         @empty
         <tr>
            <td colspan="7">Aucun paiement effectué</td>
         </tr>
         @endforelse
                
             
    @else
                  <tr>
                <td colspan="7">Aucun payement retrouvé pour l'instant</td>
            </tr>
    @endif
        </tbody> 
</table>
<div class="card-footer">
    <div class="float-left">
      {{ $ps->links() }}
    </div>
  </div> 

@endsection