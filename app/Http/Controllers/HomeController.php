<?php

namespace App\Http\Controllers;

use App\Models\Souscriptions;
use App\Models\Users\Payement;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['souscriptions'] = Souscriptions::where('email',Auth()->user()->email)->paginate(10);
        $data['pay'] = Payement::where('souscription_id',$data['souscriptions']->value('id'))->paginate(10);
       /*  if(empty($data['souscriptions']->id)){
            return redirect('/home')->with('message','Vous netre un souscrits a limmobilier de Abdoul Services !');
        } */
    
        return view('homm',$data);
    }
}
