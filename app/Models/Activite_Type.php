<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite_Type extends Model
{
    use HasFactory;
    protected $table='Activite_type';
    protected $primarykey='id';
    protected $fillable = [ 'type_activite', 'caracteristic', 'items','typedonne',];
    protected $casts=['caracteristic'=>'array','typedonne'=>'array'];
    //protected $casts=['typedonne'=>'array',];
    protected $guarded=[];


    

}
