<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.search', [
            'users' => User::where('UserID', '!=', auth()->user()->UserID)
                ->where(function($query) {
                    $query->where('username', 'like', '%'.$this->search.'%')
                          ->orWhere('NamaLengkap', 'like', '%'.$this->search.'%');
                })->get()
        ]);
    }
    public function mount(Request $request){
        $this->search = $request->search;
    }
}
