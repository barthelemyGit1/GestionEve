<?php

namespace App\Models;

use App\Models\Users\Payement;
use App\Models\personnels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souscriptions extends Model
{
    use HasFactory;
    protected $table ='souscriptions';
    protected $fillable = [
        'personnel_id',
        'modePayement',
        'dateDebut',
        'dateFin',
        'image',
        'email',
        'montantTotal',
        'typeProduit',
        'site',
        'typeLogement',
        'superficieLogement',
        'montantRestant',
        'montantPayé',
    ];


    public function payement(){
        return $this->hasMany(Payement::class);
 }
 public function personnel(){
    return $this->belongsTo(Personnels::class);
}
}
