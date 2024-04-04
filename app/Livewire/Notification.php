<?php

namespace App\Livewire;

use App\Models\Notifikasi;
use Livewire\Component;

class Notification extends Component
{
    public $on_page = 20;
    public function render()
    {
        return view('livewire.notification',[
            'notifications' => Notifikasi::where('UserID', auth()->user()->UserID)->latest()->paginate($this->on_page),
        ]);
    }
    public function loadMore(){
        $this->on_page += 20;
    }
}
