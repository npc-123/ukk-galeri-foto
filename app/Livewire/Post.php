<?php

namespace App\Livewire;

use App\Models\Foto;
use App\Models\User;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Livewire\Component;

class Post extends Component
{
    protected $listeners = ['editComment'];
    public $slug;
    public $post;
    public $user;
    public $textComment;
    public $commentTotal;
    public $likeTotal;
    public function render()
    {
        $comments = KomentarFoto::where('FotoID', $this->post->FotoID)->get();
        $this->commentTotal = $comments->count();

        $userComment = KomentarFoto::where('UserID', auth()->user()->UserID)->where('FotoID', $this->post->FotoID)->first();
        return view('livewire.post', [
            'comments' => $comments,
            'userComment' => $userComment
        ]);
    }
    public function mount($slug){
        $this->slug = $slug;
        $this->post = Foto::where('slug', $slug)->first();
        $this->user = User::find($this->post->UserID);

        

        $this->likeTotal = LikeFoto::where('FotoID', $this->post->FotoID)->count();
        $likeStatus = LikeFoto::where('UserID', auth()->user()->UserID)->where('FotoID', $this->post->FotoID)->first();
        $this->dispatch('like', liked: $likeStatus ? false : true);
    }
    public function like(){
        $like = LikeFoto::where('UserID', auth()->user()->UserID)->where('FotoID', $this->post->FotoID)->first();
        if ($like){
            $like->delete();
            $this->likeTotal = LikeFoto::where('FotoID', $this->post->FotoID)->count();
            $this->dispatch('like', liked: true);
        } else {
            LikeFoto::create([
                'FotoID' => $this->post->FotoID,
                'UserID' => auth()->user()->UserID,
                'TanggalLike' => date('Y-m-d')
            ]);
            $this->likeTotal = LikeFoto::where('FotoID', $this->post->FotoID)->count();
            $this->dispatch('like', liked: false);
        }
    }
    public function newComment(){
        $komentar = KomentarFoto::create([
            'FotoID' => $this->post->FotoID,
            'UserID' => auth()->user()->UserID,
            'IsiKomentar' => $this->textComment,
            'TanggalKomentar' => date('Y-m-d')
        ]);
        $this->reset('textComment');
        // $this->dispatch('newComment', id: $komentar->KomentarID);
        // $this->dispatch('refreshComponent');
        return $this->redirect('/p/'.$this->slug, navigate: true);
    }
    public function editComment($KomentarID, $IsiKomentar){
        if (KomentarFoto::where('KomentarID', $KomentarID)->where('UserID', auth()->user()->UserID)->first()){
            $comment = KomentarFoto::find($KomentarID);
            $comment->IsiKomentar = $IsiKomentar;
            $comment->save();
            $this->dispatch('refreshComponent');        
            // return $this->redirect('/p/'.$this->slug, navigate: true);
            
        }
    }
    public function deleteComment($KomentarID){
        if (KomentarFoto::where('KomentarID', $KomentarID)->where('UserID', auth()->user()->UserID)->first()){
            $comment = KomentarFoto::find($KomentarID);
            $comment->delete();
            $this->dispatch('refreshComponent');
        }
    }
}
