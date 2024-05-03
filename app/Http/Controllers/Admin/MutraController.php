<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\HistoCotisation;
use App\Models\Logement;
use App\Models\Membre;
use App\Models\Parcelle;
use App\Models\Personnels;
use App\Models\ReglementCoti;
use App\Models\Souscriptions;
use Carbon\Carbon;


class MutraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        function compter(){
            $maint=Carbon::now();
            $maintena=$maint->format('m/y');
            $totalregle=ReglementCoti::All();
            $i=1;$j=0;
            for($i=1;$i<$totalregle->count();$i++){
                if(Carbon::parse($totalregle[$i]->pour_le_mois)->format('m/y')==$maintena){
                     $j+=1;  
                   }
            }
            return $j;
        }

        $data['reglementAjour']=compter();
        $data['nbrlogement']=count(Logement::all());
        $data['nbrparcelle']=count(Parcelle::All());
        $data['nbrSouscription']=count(Souscriptions::All());
        $data['categorie']=Categorie::All();
        $data['nombrcategorie']=count(Categorie::All());
        $data['membre']=Membre::All();
        $data['nombremembre']=count(Membre::All());
        $data['personnel']=count(Personnels::All());
        $data['reglement']=ReglementCoti::All();
        $data['histocotisation']=HistoCotisation::All();
        return view('mutra_unb',$data);
    }
}
