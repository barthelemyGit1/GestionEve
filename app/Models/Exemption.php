<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemption extends Model
{
    use HasFactory;

    protected $table='Exemption';
    protected $primarykey='id';
    protected $fillable = ['anneeExcempt','motif','nbrMois','membre_id','startexcempt','endexempt'];
    protected $guarded=[];


    public function membre(){
        return $this->belongsTo(Membre::class);
    }
}
