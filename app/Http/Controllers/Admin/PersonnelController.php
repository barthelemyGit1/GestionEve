<?php

namespace App\Http\Controllers\Admin;

use App\Models\Personnels;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Livewire\WithPagination;

class PersonnelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public function index(Request $request)
    {
        $data['critere'] = $request->get('critere', 'tel');
        $data['q']= $request->get('q');
        $data['personnel']=Personnels::where($data['critere'], 'like', '%' .$data['q']. '%')->orderBy('id','desc')->paginate(5);
       //$data['personnel']=Personnels::all();
        return view('Admin/personnel.List_personnel', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/personnel.Add_personnel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           
            'nom' =>'required | string',
            'service'=>'required | string', 
            'tel' =>'required | string',
            'cnib'      =>'required | string',
            'dateNaiss' =>'required | date',
            'email' =>'  required | email',


        ]);

        personnels::create([
            'nom' => $request->nom,
            'matricule'=>$request->matr,
            'service' => $request->service,
            'tel' => $request->tel,
            'cnib' => $request->cnib,
            'dateNaiss' => $request->dateNaiss,
            'email'=>$request->email,
            'salaire'=>$request->salaire,
           

        ]);
        return  redirect('/personnel')->with('success', 'Personnel ajouté avec succes!');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnels  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnels $personnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnels  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Personnels $personnel)
    {
        $data['personnel']=$personnel;
        return view('Admin/personnel.Edit_personnel',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personnels  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnels $personnel)
    {
        $request->validate([
            'nom' =>'required | string',
            'service'=>'required | string', 
            'tel' =>'required | string',
            'cnib'      =>'required | string',
            'dateNaiss' =>'required | date',
            'email' =>   'required | email',
        ]);

        $personnel->nom=$request->nom;
        $personnel->service=$request->service;
        $personnel->tel=$request->tel;
        $personnel->email = $request->email;
        $personnel->cnib=$request->cnib;
        $personnel->dateNaiss=$request->dateNaiss;
        $personnel->salaire=$request->salaire;
        $personnel->matricule=$request->matr;       
        $personnel->save();


        return  redirect('personnel')->with('success', 'Mofification effectuée avec succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnels  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Personnels::find($id)->delete();
        return back()->with('success', 'personnel supprimé avec succés!');

    }
}
