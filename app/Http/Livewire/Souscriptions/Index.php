<?php

namespace App\Http\Livewire\Souscriptions;
use App\Models\Souscriptions;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $s;

    public function deleteSouscriptions($s)
    {
        //dd($category_id);
        $this->s = $s;
    }

    public function destroySouscriptions()
    {
        $ss = Souscriptions::find($this->s);
        /*$path = 'uploads/souscription/'.$s->image;

        if(File::exists($path)){

            File::delete($path);

        }*/
        $ss->delete();
        session()->flash('message','La souscription a été supprimer avec succès!');       
        $this->dispatchBrowserEvent('close-modal'); 
    }


    public function render()
    {
        
        $souscriptions = Souscriptions::orderBy('id','DESC')->paginate(6);
        return view('livewire.souscriptions.in',['souscriptions'=>$souscriptions]);
    }

}
