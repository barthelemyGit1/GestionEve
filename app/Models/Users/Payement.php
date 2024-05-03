<?php

namespace App\Models\Users;

use App\Models\Souscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payement extends Model
{
    use HasFactory;
    protected $table ='users_payement';
    use HasFactory;
    protected $fillable = [
        'souscription_id',
        'numeroRecu',
        'datePayBanq',
        'image',
        'montant',
        'statut',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function souscription(){
        return $this->belongsTo(Souscriptions::class);
 }



}
