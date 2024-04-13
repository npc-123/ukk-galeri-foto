<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Foto;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class EditPost extends Component
{
    use WithFileUploads;
    protected $listeners = ['newAlbum'];
    public $slug;
    public $post;
    public $judulPost;
    public $deskripsiPost;
    public $albumPost;
    public $imagePost;
    public $oldImagePost;
    public function render()
    {
        return view('livewire.edit-post', [
            'albums' => Album::where('UserID', auth()->user()->UserID)->get(),
        ]);
    }
    public function mount($slug){
        $this->slug = $slug;
        $this->post = Foto::where('slug', $slug)->first();
        if ($this->post->UserID != auth()->user()->UserID){
            return abort(403);
        }
        $this->judulPost = $this->post->JudulFoto;
        $this->deskripsiPost = $this->post->DeskripsiFoto;
        $this->albumPost = $this->post->AlbumID;
        $this->oldImagePost = $this->post->LokasiFile;
    }
    public function updated($name, $value){
        $this->resetValidation($name);
        $this->resetErrorBag($name);
    }
    public function newAlbum($namaAlbum, $deskripsiAlbum)
    {
        $modelAlbum = new Album();
        $slug = $this->generateUniqueRandomLetters(6, $modelAlbum, 'slug');
        $album = Album::create([
            'slug' => $slug,
            'NamaAlbum' => $namaAlbum,
            'Deskripsi' => $deskripsiAlbum,
            'TanggalDibuat' => date('Y-m-d'),
            'UserID' => auth()->user()->UserID
        ]);
        $this->dispatch('getAlbumId', albumId: $album->AlbumID, albumName: $album->NamaAlbum);
    }
    public function updatePost(){
        $this->validate([
            'albumPost' => 'required',
            'judulPost' => 'required',
            'deskripsiPost' => 'required|max:225'
        ],[
            'albumPost.required' => 'Album tidak boleh kosong',
            'judulPost.required' => 'Judul harus diisi',
            'deskripsiPost.required' => 'Deskripsi harus diisi',
            'deskripsiPost.max' => 'Deskripsi maksimal 100 karakter'
        ]);

        $user = User::where('UserID', auth()->user()->UserID)->first();
        $data = [
            'JudulFoto' => $this->judulPost,
            'DeskripsiFoto' => $this->deskripsiPost,
            'AlbumID' => $this->albumPost,
        ];
        if ($this->imagePost && $this->imagePost->isValid()){
            $newImagePath = $this->imagePost->store('image/user/'. $user->UserID . '/post', 'public');
            $imagePath = storage_path('app/public/' . $newImagePath);
        
            if (file_exists($imagePath)) {
                $data['LokasiFile'] = $newImagePath;
            }
        }        
        if ($this->post->update($data)) {
            return $this->redirect('/p/'.$this->slug);
        } else {
            $this->dispatch('error', type: 'error', title: 'Ada yang salah', message: 'Gagal membuat postingan');
        }
    }
    public function generateUniqueRandomLetters($length, $model, $column) {
        do {
            $randomLetters = Str::random($length);
        } while ($model->where($column, $randomLetters)->exists());

        return $randomLetters;
    }
}
