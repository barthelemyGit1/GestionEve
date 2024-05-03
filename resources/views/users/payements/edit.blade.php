@extends('layouts.appp')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Modifier les informations du payements
                    <a href="{{ url('users/payements') }}" class="btn btn-primary btn-sm text-white float-end">Annuler</a>
                </h3>
            </div>
           
            <div class="card-body">

                <form action ="{{ url ('users/payements'.$p->id) }}" method ="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                    <div class="col-md-12 mb-3">
                            <label>Numero du recu</label>
                            <input type="text" name="numeroRecu" class="form-control" value="{{ $p->numeroRecu}}"/>
                            @error('numeroRecu')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label>Date du versement à la banque</label>
                            <input type="date" name="datePayBanq" class="form-control" value="{{ $p->datePayBanq}}"/>
                            @error('datePayBanq')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Date d'envoie du recu</label>
                            <input type="date" name="datePaySite" class="form-control" value="{{ $p->datePaySite }}"/>
                            @error('datePaySite')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Montatnt du versement</label>
                            <input type="text" name="montant" class="form-control" value="{{ $p->montant}}"/>
                            @error('montant')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Numero de votre Cnib</label>
                            <input type="text" name="NCNIB" class="form-control" value="{{ $p->NCNIB}}"/>
                            @error('NCNIB')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label>Photo du recu</label>
                            <input type="file" name="image" class="form-control" value="{{ $p->image}}"/>
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Modifier</button>
                        </div>

                    </div>
                </form>

            </div>
            </div>
        </div>
    </div>
</div>
@endsection