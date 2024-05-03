<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Versement;
use App\Models\Souscriptions;
use App\Models\Users\Payement;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ConsulterVController extends Controller
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
        $s = Souscriptions::where('email',auth()->user()->email)->paginate(10);
        //$pay = Payement::where('uname',$)->get(); 
        return view('users/consulterV.indexe',compact('s'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $s = Souscriptions::find($id);
        $p = Payement::where('souscription_id',$s->id)->get();
        
        //$pay = Payement::where('uname',$)->get(); 
        return view('consulterV.indexe',compact('p','s'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
