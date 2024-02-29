<?php

namespace App\Livewire;

use App\Models\Foto;
use Livewire\Component;

class Home extends Component
{
    public $on_page = 30;
    public function render()
    {
        return view('livewire.home', [
            'posts' => Foto::latest()->take($this->on_page)->get(),
        ]);
    }
    public function loadMore(){
        $this->on_page += 20;
    }
}
