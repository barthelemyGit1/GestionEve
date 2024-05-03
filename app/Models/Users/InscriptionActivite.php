<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptionActivite extends Model
{
    use HasFactory;
    protected $table ='inscription_activite';
    protected $fillable = [
        'name',
        'email',
        'activite',
    ];
}
