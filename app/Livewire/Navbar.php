<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    protected $listeners = ['updateSuccess' => '$refresh'];
    public $searchInput;
    public function render()
    {
        $this->searchInput = request('search');
        return view('livewire.navbar');
    }
    public function search(){
        return $this->redirect('/search?search='.$this->searchInput, navigate: true);
    }
}
