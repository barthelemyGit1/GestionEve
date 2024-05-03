<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementCoti extends Model
{
    use HasFactory;

    protected $table='ReglementCoti';
    protected $primarykey='id';
    protected $fillable = [ 'membre_id','montant','pour_le_mois','categorie_id'];
    protected $guarded=[];


    public function membre(){
        return $this->belongsTo(Membre::class);
    }

    
}
