<?php

namespace App\Http\Livewire\Souscriptions;

use Livewire\Component;
use App\Models\Souscriptions;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Contrats extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        
        $souscriptions = Souscriptions::orderBy('id','DESC')->paginate(6);
        return view('livewire.souscriptions.contrats',['souscriptions'=>$souscriptions]);
    }
}
