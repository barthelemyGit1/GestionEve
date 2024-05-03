<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;

    protected $table='Logement';
    protected $primarykey='id';
    protected $fillable = [ 'souscription_id','nature', 'site','superficie','superficieattribuee','nature_2', 'section', 'lot','numvilla'];
    protected $guarded=[];
}
