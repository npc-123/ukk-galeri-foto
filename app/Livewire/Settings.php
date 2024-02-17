<?php

namespace App\Livewire;

use Livewire\Component;

class Settings extends Component
{
    public $name;
    public $username;
    public $email;
    public $address;

    public function render()
    {
        return view('livewire.settings');
    }
    public function mount(){
        $this->name = auth()->user()->NamaLengkap;
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->address = auth()->user()->Alamat;
    }
    public function resetInput(){
        $this->mount();
    }
}
