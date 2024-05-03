<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoCotisation extends Model
{
    use HasFactory;

    protected $table='HistoCotisation';
    protected $primarykey='id';
    protected $fillable = [ 'categorie_id','montant'];
    protected $guarded=[];


    public function Categorie(){
        return $this->HasOne(Categorie::class);
 }
}


