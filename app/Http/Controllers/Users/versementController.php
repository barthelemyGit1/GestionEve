<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Versement;
use App\Models\Souscriptions;
use App\Models\Users\Payement;
use Livewire\WithPagination;

class versementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    //
    public function index(){
        $s = Souscriptions::all()->paginate(10);
        return view('admin.versements.index',compact('s'));
    }

    public function create()
    {
        $s = Souscriptions::all();
        $p = Payement::all();
        return view('admin.Versements.crea',compact('s','p'));
    }

    public function store(Request $request, $id)
    {
       /*  $request->validate([
            'nom' =>'required' ,
            'prenom' => 'required', 
            'tel' => 'required', 
            'typeProduit'=> 'required',
            'dateNaissance'=> 'required',
            'montantTotal'=> 'required',
            'montantVersement'=> 'required',
            'montantRestant'=> 'required',
        ]); 
   
        Versement::create([
            'nom' =>$request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'typeProduit' => $request->typeProduit,
            'dateNaissance' => $request->dateNaissance,
            'montantTotal' => $request->montantTotal,
            'montantVersement' => $request->montantVersement,
            'montantRestant' => $request->montantRestant,   
        ]);
          //$payé=Souscriptions::where('id',$id)->get('montantPayé');
         // Souscriptions::where('id',$id)->update(['montantPayé'=> $request->montantVersement+$payé]);
         // Souscriptions::where('id',$id)->update(['montantRestant'=>'montantTotal'-'montantPayé']);

        return redirect('Versements')->with('message','Paiement ajouté avec succès!');
        //echo($payé); */
   
    }
    public function edit(){

        $s = Souscriptions::where('id==id');
        $p = Payement::all();
        
        return view('admin.Versements.consulter',compact('s'));
    }
}
