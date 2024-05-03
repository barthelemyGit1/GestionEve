<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\Activite_detail;
use App\Models\Activite_Type;
use App\Models\InscritActivite;
use App\Models\Personnels;
use App\Notifications\InscriptionActivite;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Console\View\Components\Alert;
use Livewire\WithPagination;
use Symfony\Contracts\Service\Attribute\Required;

class ActiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $data['critere'] = $request->get('critere', 'type_activite');
            $data['q']= $request->get('q');
            $data['actitypes']= Activite_Type::where($data['critere'], 'like', '%' .$data['q']. '%')->paginate(6);
            return view('admin.Activite.index',$data);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
           
       }
        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Activite  $activite
         * @return \Illuminate\Http\Response
         */
        public function show($activite)
        {
            $data['acti']=Activite_detail::find($activite);
            $data['nombreparticip']=InscritActivite::where('activite_id',$activite)->where('reponse','accepté')->paginate(6);
            $data['nombrDemand']=InscritActivite::where('activite_id',$activite)->where('reponse','En Cours...')->paginate(6);
            return view('admin.Activite.showparticip',$data);
        }
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Activite  $activite
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $data['activitedetail']=Activite_detail::find($id);
            $actitype_type=$data['activitedetail']->type_activite;
            $actitype_id=Activite_Type::where('type_activite',$actitype_type)->value('id');
            $data['activityp']=Activite_Type::find($actitype_id);
            return view('admin.Activite.EditActivit',$data);
        }
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Activite  $activite
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $i=0;
            $y2="donne_";
            $valuchamp=array();
            $activite=Activite_detail::find($id);
            $nombre=count($activite->champvalues);
            for($i==0; $i<$nombre;$i++){
                 $valuchamp[$i]= $request[$y2.$i];
                    }
                $activite->type_activite=$request->type;
                $activite->champvalues=$valuchamp;
                $activite->save();
            return redirect('Activite')->with('success', 'Operation reussi!');
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Activite  $activite
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            Activite_Type::find($id)->delete();
            return back()->with('success', 'Operation reussi');
        }
         /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Activite  $activite
         * @return \Illuminate\Http\Response
         */
        public function remove($id)
        {
            Activite_detail::find($id)->delete();
            return back()->with('success', 'Operation reussi');
        }
        public function notify($activite_id){
            if(auth()->user()){                   
                 $user = auth()->user();
                 auth()->user()->notify(new InscriptionActivite($user, $activite_id));
            }
            return redirect('Activite')->with('success', 'votre demande est en cours de traitement!');  
        }

        public function adminparticipation(Request $request)
        {
            if($request->participant!='')
            {
                if($request->acti_id)
                {
                   InscritActivite::create([
                       'personnel_id' =>$request->participant,
                       'activite_id' =>$request->acti_id,
                       'reponse'  =>"accepté",
                      ]);
                   $nombparticip=count(InscritActivite::where('reponse','accepté')->where('activite_id',$request->acti_id)->get());
                   Activite_detail::where('id',$request->acti_id)->update(['particitpants'=>$nombparticip]);
                   return back()->with('success','OPERATION REUSSI!');
                }
            else{
                echo('veuillez choisir le participant');
            }
           }  
          
        }

        
        public function RefusParticip($id){
            if($id){
                $utilisateur=0;
               $nombre=User::count();
               $i=1;
                for($i==1; $i<=$nombre; $i++){
                     $users=User::find($i);
                     if($users->unreadNotifications->find($id)!=null){
                         $utilisateur=$i;
                     }                  
                }
                     $user=User::find($utilisateur);
                     $user->unreadNotifications->where('id',$id)->markAsRead();
            }
            return back()->with('success','OPERATION REUSSI!');

        }
     
        public function RepParticipation($id){
            if($id){
                $utilisateur=0;
               $nombre=User::count();
               $i=1;
                for($i==1; $i<=$nombre; $i++){
                     $users=User::find($i);
                     if($users->unreadNotifications->find($id)!=null){
                         $utilisateur=$i;
                     }                  
                }
                     $user=User::find($utilisateur);
                     $user->unreadNotifications->where('id',$id)->markAsRead();
            }
            $personnel=User::find($utilisateur);
            $personnel_id=$personnel['id'];
            $num=$user->unreadNotifications->find($id);
            $activite_id=$num->data['id_activite'];
            $reponse="accepté";

            InscritActivite::create([
                'personnel_id' =>$personnel_id,
                'activite_id' => $activite_id,
                'reponse'  =>$reponse,
            ]);
            $nombparticip=count(InscritActivite::where('reponse','accepté')->where('activite_id',$activite_id)->get());
            Activite_detail::where('id',$activite_id)->update(['particitpants'=>$nombparticip]);
            return back()->with('success','OPERATION REUSSI!');;
        }
         /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Activite  $activite
         * @return \Illuminate\Http\Response
         */
        public function activitetype(Request $request){
            $data['type']=$request->type;
            $data['nombre']=$request->caracteristique;
            return view('admin.Activite.actitype', $data); 
        }

        public function setactiviteType(Request $request, $nombre)
        {
            $items=count(Activite_detail::where('type_activite', $request->type)->get());
            $i=0;
            $y="champ_";
            $y2="typechamp_";
            $j=0;
            $cars=array();
            $typchamp=array();
            for($i==0; $i<$nombre;$i++){
                $cars[$i]= $request[$y.$i];
                    }

            for($j==0; $j<$nombre;$j++){
                 $typchamp[$j]= $request[$y2.$j];
                    }
            Activite_Type::create([
                'type_activite'=>$request->type,
                'caracteristic'=> $cars,
                'typedonne'=>$typchamp,
                'items'=>$items,
            ]); 
            
            return redirect('Activite')->with('success', 'Operation Reussi!');
        }

        public function actidetail($id){
            $data['activitype']=Activite_Type::where('id', $id)->get();
            $data['activitypes']=Activite_Type::where('id', $id)->get();
            $nomb=Activite_Type::find($id);
            $nomb2=$nomb->caracteristic;
            $data['nombre']=count($nomb2);
            $data['i']=0;
            $data['j']=0;
            $data['type']=$nomb->type_activite;
            $data['actividetails']=Activite_detail::where('type_activite',$nomb->type_activite)->paginate(10);
            $data['personnel']=Personnels::All();
            return view('admin.Activite.actidetail', $data);
        }
    
        public function ajoutactideail (Request $request, $nombre){
            $i=0;
            $y2="donne_";
            $valuchamp=array();

            for($i==0; $i<$nombre;$i++){
                 $valuchamp[$i]= $request[$y2.$i];
                    }
            Activite_detail::create([
                'type_activite'=>$request->type,
                'champvalues'=>$valuchamp,
            ]); 
            $items=count(Activite_detail::where('type_activite', $request->type)->get());
            Activite_Type::where('type_activite', $request->type)->update(['items'=>$items]);
            $data['actitype']=Activite_Type::All();
            return back()->with('success', 'Operation Reussi !');
        }
    public function test(){
        return view('admin.Activite.test');
    }

    public function register(Activite_detail $actividetails)
    {
        //auth()->user()->events()->attach($actividetails->id);
        //return redirect()->back()->with('success', 'Vous vous êtes inscrit à l\'événement.');
    }

    public function unregister(Activite_detail $actividetails)
    {
        //auth()->user()->events()->detach($actividetails->id);
        
        //return redirect()->back()->with('success', 'Vous vous êtes désinscrit de l\'événement.');
    }

    public function allparticiped(){
        $actividetails = Activite_detail::find($id);
        $participants = $actitype->participants;
        

    }
    
}
