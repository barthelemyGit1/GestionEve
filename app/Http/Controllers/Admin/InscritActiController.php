<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InscritActivite;
use App\Models\User;
use Livewire\WithPagination;

class InscritActiController extends Controller
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
     public function index()
    {
        
            $data['users']=User::all();
            //$data['notification']=notifiaction::All();
            return view('admin.notification',$data);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        InscritActivite::create([
            'personnel_id' =>$data['personnel'],
            'activite_id' => $data['activite'],
        ]);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update( )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inscription=InscritActivite::find($id)->delete();
        return back()->with('success', 'Opération Reussi !');
    }
}
