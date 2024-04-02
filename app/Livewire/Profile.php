<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Foto;
use App\Models\LikeFoto;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Profile extends Component
{
    public $on_page = 30;
    public $username;
    public $page;
    public $pageAlbum = false;
    public function render()
    {
        $user = User::where('username', $this->username)->first();
        $posts = null;
        if ($this->page == null) {
            $posts = Foto::latest()->take($this->on_page)->where('UserID', $user->UserID)->get();
        } elseif ($this->page == 'album') {
            $albumId = Album::where('UserID', $user->UserID)->pluck('AlbumID');
            $posts = Album::whereIn('AlbumID', $albumId)->latest()->take($this->on_page)->get();
            $allFoto = Foto::whereIn('AlbumID', $albumId)->selectRaw('AlbumID, COUNT(FotoID) as total')->groupBy('AlbumID')->get()->keyBy('AlbumID');

            $lastUpdated = Foto::whereIn('FotoID', function ($query) use ($albumId) {
                $query->selectRaw('max(FotoID)')
                    ->from('foto')
                    ->whereIn('AlbumID', $albumId)
                    ->groupBy('AlbumID');
            })->pluck('updated_at', 'AlbumID');

            $lastUpdated = $lastUpdated->map(function ($timestamp) {
                return Carbon::parse($timestamp)->diffForHumans();
            });
        } elseif ($this->page == 'liked') {
            $likedFotoId = LikeFoto::where('UserID', $user->UserID)->pluck('FotoID');
            $posts = Foto::whereIn('FotoID', $likedFotoId)->latest()->take($this->on_page)->get();
        }
        return view('livewire.profile', [
            'posts' => $posts,
            'user' => $user,
            'pageAlbum' => $this->pageAlbum,
            'allFoto' => $allFoto ?? null,
            'lastUpdated' => $lastUpdated ?? null,
            'imageUrl' => $imageUrl ?? null
        ]);
    }
    public function mount($user, $page = null, $album = null)
    {
        $isUsername = User::where('username', $user)->first();
        if ($isUsername && $page == null && $album == null) {
            $this->username = $user;
        } elseif ($isUsername && $page == 'album') {
            $this->username = $user;
            $this->page = $page;
        } elseif ($isUsername && $album != null) {
            $this->username = $user;
            $this->pageAlbum = true;
        } elseif ($isUsername && $page == 'liked' && $isUsername->UserID == auth()->user()->UserID) {
            $this->username = $user;
            $this->page = $page;
        } else {
            abort(404);
        }
    }
    public function loadMore()
    {
        $this->on_page += 20;
    }
}
