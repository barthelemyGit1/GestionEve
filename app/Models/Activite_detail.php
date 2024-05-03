<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite_detail extends Model
{
    use HasFactory;
    protected $table='Activite_detail';
    protected $primarykey='id';
    protected $fillable = [ 'type_activite', 'champvalues', 'items','Activite__type_id',];
    protected $casts=['champvalues' =>'array'];
    protected $guarded=[];

   
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function participants()
    {
        return $this->belongsToMany(User::class, 'InscritActivite');
    }
}
