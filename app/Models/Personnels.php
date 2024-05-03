<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnels extends Model
{
    use HasFactory;
    protected $table='personnels';
    protected $primarykey='id';
    protected $fillable = ['nom','dateNaiss', 'tel','cnib', 'service', 'email', 'salaire','matricule'];
    protected $guarded=[];


    public function membre(){
        return $this->belongsTo(Membre::class);
    }

    public function inscritActivite(){
        return $this->hasMany(InscritActivite::class);
    }
    public function souscription(){
        return $this->hasMany(Souscriptions::class);
    }
}
