<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Exemption;
use App\Models\HistoCotisation;
use App\Models\Logement;
use App\Models\Membre;
use App\Models\Parcelle;
use App\Models\Personnels;
use App\Models\ReglementCoti;
use App\Models\Souscriptions;
use App\Models\Users\Payement;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class DashdoardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    use WithPagination;
    protected $paginationTheme = "bootstrap";

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
            function comptexempt(){
                $maint=Carbon::now();
                $maintena=$maint;
                $totalregle=Exemption::All();
                $i=0;$j=0;
                for($i=0;$i<$totalregle->count();$i++){
                    if(Carbon::parse($totalregle[$i]->startexcempt) <= $maintena && Carbon::parse($totalregle[$i]->endexempt) >= $maintena ){
                         $j+=1;  
                       }
                }
                return $j;
            }

            function comptVersem(){
                $nows=Carbon::now();
                $maintenant=$nows->format('m/y');
                $versement=Payement::where('statut','validé')->get();
                $i=0;$j=0;
                for($i=0;$i< count($versement);$i++){
                    if(Carbon::parse($versement[$i]->datePayBanq)->format('m/y') == $maintenant){
                        $j+=1;
                    }
                }return $j;

            }
        $data['versement']=comptVersem();
        $data['totalversement']=count(Souscriptions::where('modePayement','apport personnel')->get()) ;
        $data['comptexempt']=comptexempt();
        $data['totalexempt']=count(Exemption::All());
        //$data['comptexempt']=count(Exemption::where('startexcempt', $maintena)->where('endexempt' , $maintena)->get());
        $data['reglementAjour']=compter();
        $data['nbrlogement']=count(Logement::all());
        $data['nbrparcelle']=count(Parcelle::All());
        $data['nbrSouscription']=count(Souscriptions::All());
        //$data['categorie']=Categorie::All();
        $data['nombrcategorie']=count(Categorie::All());
        //$data['membre']=Membre::All();
        $data['nombremembre']=count(Membre::All());
        $data['personnel']=count(Personnels::All());
        $data['reglement']=ReglementCoti::All();
        return view('admin.mutra_unb',$data);
    }
}

