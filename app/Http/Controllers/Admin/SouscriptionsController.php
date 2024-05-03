<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Souscriptions;
use App\Http\Requests\SouscriptionsformRequest;
use Illuminate\Support\Facades\File;
use App\Models\Personnels;
use App\Models\Parcelle;
use App\Models\Logement;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Livewire\WithPagination;

class SouscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public function index(){
       
        return view('admin.souscriptions.index');
    }

    public function contrat(Request $request){
        $data['critere'] = $request->get('critere', 'personnel_id');
        $data['q']= $request->get('q');
        $data['logement']= Souscriptions::where($data['critere'], 'like', '%' .$data['q']. '%')->paginate(2);
        $data['parcelle']= Souscriptions::where($data['critere'], 'like', '%' .$data['q']. '%')->paginate(2);
        $data['personnels_id']=Personnels::all();
        return view('admin.souscriptions.contrats',$data);
    }

    public function createP(){
        $personnels= Personnels::all();
        return view('admin.souscriptions.creerParc',compact('personnels'));
    }
    public function createL(){
        $personnels = Personnels::all();
        return view('admin.souscriptions.creerLogement',compact('personnels'));
    }

    public function store(SouscriptionsFormRequest $request)
    {
        $id=$request['personnel_id'];
        $souscripteur=Personnels::find($id);
        $souscriptions = new Souscriptions();
        $souscriptions -> personnel_id = $souscripteur->id;
        $souscriptions -> email = $request['email'];
        $souscriptions -> modePayement = $request['modePayement'];
        $souscriptions -> dateDebut = $request['dateDebut'];
        $souscriptions -> dateFin = $request['dateFin'];
        $souscriptions -> montantTotal = $request['montantTotal'];
        $souscriptions -> site = $request['site'];
        $souscriptions -> typeLogement = $request['typeLogement'];
        $souscriptions -> superficieLogement = $request['superficieLogement'];
        $souscriptions -> typeProduit = $request['typeProduit'];
        $souscriptions -> montantRestant = $request['montantTotal'];
        $souscriptions->save();
        $sous_id=Souscriptions::max('id');
        
        if($request->typeProduit =='Parcelle'){
            Parcelle::create([
            'souscription_id' =>$sous_id,
            'nature' =>$request->typeProduit,
            'site' => $request->site,
            'superficie' => $request->superficieLogement,
            'superficieattribuee' => $request->superficieattribuee,  
            'nature_2' => $request->typeLogement,
            'section' => $request->section,
            'lot' => $request->lot,
            'numvilla' => $request->numvilla,
            ]);
            return redirect('admin/souscriptions')->with('message',' La souscription a été ajouté avec succès!');  

        }else{
            Logement::create([
                'souscription_id' =>$sous_id,
                'nature' =>$request->typeProduit,
                'site' => $request->site,
                'superficie' => $request->superficieLogement,
                'superficieattribuee' => $request->superficieattribuee,
                'nature_2' => $request->typeLogement,
                'section' => $request->section,
                'lot' => $request->lot,
                'numvilla' => $request->numvilla,
            ]);
            return redirect('admin/souscriptions')->with('message',' La souscription a été ajouté avec succès!');  
        }
    }  

    public function edit(int $id){
        $s = Souscriptions::findOrFail($id);
        $pers = Personnels::all();
        return view('admin.souscriptions.edite',compact('s','pers'));
    }

    public function update(SouscriptionsFormRequest $request,$s)
    {   
        $validatedData = $request->validated();
        $s = Souscriptions::findOrFail($s);;
        $s -> personnel_id = $validatedData['personnel_id'];
        $s -> modePayement = $validatedData['modePayement'];
        $s -> dateDebut = $validatedData['dateDebut'];
        $s -> dateFin = $validatedData['dateFin'];
        $s -> montantTotal = $validatedData['montantTotal'];

        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/souscripteurs/', $filename);
            $souscriptions -> image = $filename;
        }*/
        
        $s -> site = $validatedData['site'];
        $s -> typeLogement = $validatedData['typeLogement'];
        $s -> superficieLogement = $validatedData['superficieLogement'];
        $s -> typeProduit = $validatedData['typeProduit'];

        $s->update();
        return redirect('admin/souscriptions')->with('message',' Les informations de la souscription ont été modifier avec succès!');   
    }
    
 
    public function show($sous_id){
        $souscri=Souscriptions::find($sous_id);
        $personnel=Personnels::find($souscri->personnel_id);
        $parcelle=Parcelle::where('souscription_id',$sous_id);
        $logement=Logement::where('souscription_id',$sous_id);
        $etat=($souscri->montantPayé*100)/$souscri->montantTotal;
        return view('admin.souscriptions.showcontrats',compact('souscri','personnel','parcelle','logement','etat'));
    }


    public function payerPeriodique(){
    $contrat=Souscriptions::where('modePayement','retenu direct');
     $interval=DateInterval::createFromDateString('1 month');
    $debut=Carbon::parse($contrat->dateDebut); $fin=Carbon::parse($contrat->dateFin);
    $intervalpayert=new DatePeriod($debut, $interval, $fin); $actu=Carbon::now();
    $tab=array(); $i=0; $exist=0;
    }
}
