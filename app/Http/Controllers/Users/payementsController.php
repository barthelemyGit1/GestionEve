<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\Payement;
use App\Models\Souscriptions;
use App\Notifications\paiementnotification;
use App\Http\Requests\UserPayementRequest;
use App\Models\Personnels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class payementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    protected $paginationTheme = "bootstrap";
    public function index(){
        //$usermail = Auth::user()->email;
        $data['souscription'] = Souscriptions::where('email',Auth()->user()->email)->paginate(10);
        $data['p'] = Payement::where('souscription_id',$data['souscription']->value('id'))->paginate('10');
       /*  if(empty($data['souscriptions']->id)){
            return redirect('/home')->with('message','Vous netre un souscrits a limmobilier de Abdoul Services !');
        } */
        return view('users.payements.indexx',$data);
    }

    public function create($id){
        $data['sous'] = Souscriptions::find($id);
        $data['person']=Personnels::find($data['sous']->personnel_id);
       /*  if(empty($data['sous'])){
            return redirect('/home')->with('message',' Vous netre un souscripteur au logement de Abdoul Services !');
        } */
        return view('users/payements/create',$data);
    }
    
    public function store(Request $request)
    {
        $souscription=Souscriptions::find($request->souscription_id);
        if($souscription->montantRestant >= $request->montant)
        {
              $request->validate([
                  //'datePaySite' =>'required',
                  'montant' => 'required |integer', 
                  'dateBanq'=>'required | date',
                  'numrecu' =>'required | integer',
                  'souscription_id'=>'required | string',
                  ]); 


                  if($request->hasFile("image")){
                    //$destinationPath='public/images';
                    $image=$request->file('image');
                    $imageName =$image->getClientOriginalName();
                    //$path=$request->file('image')->storeAs($destinationPath, $imageName);
                    $image->move(public_path('uploads'),$imageName);

                  
        if(auth()->user()->role_as == 0){
             $saveby=auth()->user()->id;
             Payement::create([
                  'numeroRecu'  => $request->numrecu,
                   'montant' => $request->montant,
                   'datePayBanq' =>$request->dateBanq,
                   'souscription_id' =>$request->souscription_id,
                   'image'          =>$imageName    ,
                   'user_id' =>$saveby,
             ]);
            }else{
            Payement::create([
                'numeroRecu'  => $request->numrecu,
                 'montant' => $request->montant,
                 'datePayBanq' =>$request->dateBanq,
                 'souscription_id' =>$request->souscription_id,
                 'image'     =>$imageName,
            ]);
          }
                 
        }
        /* si pas d'image */
        else{
            if(auth()->user()->role_as == 0){
                $saveby=auth()->user()->id;
                Payement::create([
                     'numeroRecu'  => $request->numrecu,
                      'montant' => $request->montant,
                      'datePayBanq' =>$request->dateBanq,
                      'souscription_id' =>$request->souscription_id,
                      'user_id' =>$saveby,
                ]);
                /* si user n'est pas admin */
               }else{
               Payement::create([
                   'numeroRecu'  => $request->numrecu,
                    'montant' => $request->montant,
                    'datePayBanq' =>$request->dateBanq,
                    'souscription_id' =>$request->souscription_id,
               ]);
             }
        }
                 return  redirect('notify')->with('message',' Les informations du payements ont été envoyé avec succès!'); 
            }
            /* si montant montant depasse montant restant */
        else{
            echo('ERREUR!, Vous avez depassé le montant du contrat');
        };
   
        }
    //deleteSouscriptions({{$s->id}})
    /*$image = array();
        if($files = $request->file('image')){
                foreach($files as $file){
                    $image_name = md5( rand (1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'public/users/payements';
                    $image_url = $upload_path.$image_full_name;
                    $file->move($upload_path,$image_full_name);
                    $image[] = $image_url;
                }

                $pay->image = implode('|',$image[]);
            } */

    public function edit( Payement $p){
        return view ('users.payements.edit',compact('p'));
                
        }

    public function update(UserPayementRequest $request, $p)
    {
        $validatedData = $request->validated();

        $pay = Payement::findOrFail($p);

        $pay -> numeroRecu = $validatedData['numeroRecu'];
        $pay -> datePaySite = $validatedData['datePaySite'];
        $pay -> datePayBanq = $validatedData['datePayBanq'];
        $pay -> montant = $validatedData['montant'];

        $pay -> image = $validatedData['image'];
        $pay -> NCNIB = $validatedData['NCNIB'];        
        $p->update();
        return redirect('notify')->with('message','Informations modifiées avec succès');
    }



    public function notify(){
        if(auth()->user()){
            $paiement_id=Payement::max('id');            
             $user = auth()->user();
             auth()->user()->notify(new paiementnotification($user, $paiement_id));
        }
        //echo($paiement);
        if(auth()->user()->role_as==1)
            return redirect('/versements')->with('success', 'versement ajouté avec success, veuillez attendez la confirmation!');
        else
            return redirect('users/payements')->with('success', 'versement ajouté avec success, veuillez attendez la confirmation!');
    }


}
