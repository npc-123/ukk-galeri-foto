<?php

namespace App\Livewire;

use App\Models\Foto;
use App\Models\User;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
use App\Models\Notifikasi;
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
            $this->deleteNotification('like', $this->post->FotoID);
            $this->likeTotal = LikeFoto::where('FotoID', $this->post->FotoID)->count();
            $this->dispatch('like', liked: true);
        } else {
            LikeFoto::create([
                'FotoID' => $this->post->FotoID,
                'UserID' => auth()->user()->UserID,
                'TanggalLike' => date('Y-m-d')
            ]);
            $this->likeTotal = LikeFoto::where('FotoID', $this->post->FotoID)->count();
            if (auth()->user()->UserID != $this->user->UserID){
                $this->sendNotification($this->user->UserID, 'like', 'menyukai postigan anda', $this->post->FotoID);
            }
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
        // $this->reset('textComment');
        // $this->dispatch('newComment', id: $komentar->KomentarID);
        // $this->dispatch('refreshComponent');
        if (auth()->user()->UserID != $this->user->UserID){
            $this->sendNotification($this->user->UserID, 'komentar', 'mengomentari postigan anda', $this->post->FotoID, $komentar->KomentarID);
        }
        return $this->redirect('/p/'.$this->slug, navigate: true);
    }
    public function editPost(){
        return $this->redirect('/p/'.$this->slug.'/edit');
    }
    public function deletePost(){
        $this->deleteNotification('post', $this->post->FotoID);
        $this->post->delete();
        return redirect('/')->with('deletePost', 'Postingan berhasil di hapus');

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
            $this->deleteNotification('komentar', $this->post->FotoID, $KomentarID);
            $this->dispatch('refreshComponent');
        }
    }
    public function sendNotification($userId, $tipe, $isi, $FotoId, $KomentarId = null){
        Notifikasi::create([
            'UserID' => $userId,
            'dariUserID' => auth()->user()->UserID,
            'tipe' => $tipe,
            'isi' => $isi,
            'KomentarID' => $KomentarId,
            'FotoID' => $FotoId
        ]);
    }
    public function deleteNotification($tipe, $FotoId, $KomentarId = null){
        Notifikasi::where('tipe', $tipe)->where('FotoID', $FotoId)->where('KomentarID', $KomentarId)->delete();
    }
}
