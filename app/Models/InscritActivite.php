<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscritActivite extends Model
{
    use HasFactory;
    protected $table ='InscritActivite';
    protected $fillable = [
       'personnel_id', 'activite_id','reponse','activiteD_id'
    ];

}

