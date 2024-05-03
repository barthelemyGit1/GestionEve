<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $table='Membre';
    protected $primarykey='id';
    protected $fillable = [ 'personnel_id','categorie_id', 'Email','dateadhession'];
    protected $guarded=[];

  

    public function categorie(){
       return $this->belongsTo(Categorie::class);
    }

    public function reglement(){
        return $this->hasMany(ReglementCoti::class);
 }
    public function exemption(){
    return $this->hasMany(Exemption::class);
  }

  public function personnel(){
    return $this->belongsTo(Personnels::class);
}


 

}