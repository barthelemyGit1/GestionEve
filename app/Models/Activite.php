<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;
    protected $table='activite';
    protected $primarykey='id';
    protected $fillable = [ 'objet', 'resultattendu', 'cout','indicateur','periode','contraints', 'structure',];
    protected $guarded=[];

}

