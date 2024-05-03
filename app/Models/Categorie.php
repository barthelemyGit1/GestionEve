<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table='Categorie';
    protected $primarykey='id';
    protected $fillable = [ 'libelle','taux'];
    protected $guarded=[];


    public function membre(){
        return $this->hasMany(Membre::class);
 }

 public function histoCotisation(){
    return $this->hasMany(HistoCotisation::class);
}
}
