<?php

namespace App\Livewire;

use App\Models\Album as ModelsAlbum;
use App\Models\Foto;
use App\Models\User;
use Livewire\Component;

class Album extends Component
{
    public $on_page = 30;
    public $albumId;
    public $username;
    public function render()
    {
        return view('livewire.album',[
            'user' => User::where('username', $this->username)->first(),
            'album' => ModelsAlbum::where('AlbumID', $this->albumId)->first(),
            'posts' => Foto::where('AlbumID', $this->albumId)->latest()->take($this->on_page)->get(),
        ]);
    }
    public function mount($user, $album){
        $this->username = $user;
        $this->albumId = ModelsAlbum::where('slug', $album)->first()->AlbumID;
    }
    public function editAlbum($namaAlbum, $deskripsiAlbum){
        ModelsAlbum::where('AlbumID', $this->albumId)->update([
            'NamaAlbum' => $namaAlbum,
            'Deskripsi' => $deskripsiAlbum
        ]);
        $this->dispatch('successUpdate');
    }
    public function deleteAlbum(){
        ModelsAlbum::where('AlbumID', $this->albumId)->delete();
        return $this->redirect('/'.$this->username.'/album', navigate: true);
    }
    public function loadMore(){
        $this->on_page += 20;
    }
}
