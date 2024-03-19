<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewPost extends Component
{
    use WithFileUploads;
    protected $listeners = ['newAlbum'];
    public $judulPost;
    public $deskripsiPost;
    public $imagePost;
    public $albumPost;
    public function render()
    {
        return view('livewire.new-post',[
            'albums' => Album::where('UserID', auth()->user()->UserID)->get(),
        ]);
    }
    public function updated($name, $value){
        $this->resetValidation($name);
        $this->resetErrorBag($name);
    }
    public function newAlbum($namaAlbum, $deskripsiAlbum)
    {
        $album = Album::create([
            'NamaAlbum' => $namaAlbum,
            'Deskripsi' => $deskripsiAlbum,
            'TanggalDibuat' => date('Y-m-d'),
            'UserID' => auth()->user()->UserID
        ]);
        $this->dispatch('getAlbumId', albumId: $album->AlbumID, albumName: $album->NamaAlbum);
    }
    public function uploadPost(){
        $this->validate([
            'albumPost' => 'required',
            'imagePost' => 'required|image',
            'judulPost' => 'required',
            'deskripsiPost' => 'required|max:100'
        ],[
            'albumPost.required' => 'Album tidak boleh kosong',
            'imagePost.required' => 'Gambar tidak boleh kosong',
            'imagePost.image' => 'File harus gambar',
            'judulPost.required' => 'Judul harus diisi',
            'deskripsiPost.required' => 'Deskripsi harus diisi',
            'deskripsiPost.max' => 'Deskripsi maksimal 100 karakter'
        ]);

        $user = User::where('UserID', auth()->user()->UserID)->first();
        $modelFoto = new Foto();
        $slug = $this->generateUniqueRandomLetters(6, $modelFoto, 'slug');
        $data = [
            'JudulFoto' => $this->judulPost,
            'DeskripsiFoto' => $this->deskripsiPost,
            'TanggalUnggah' => date('Y-m-d'),
            'AlbumID' => $this->albumPost,
            'UserID' => auth()->user()->UserID,
            'slug' => $slug
        ];
        if ($this->imagePost && $this->imagePost->isValid()){
            $newImagePath = $this->imagePost->store('image/user/'. $user->UserID . '/post', 'public');
            $imagePath = storage_path('app/public/' . $newImagePath);
    
            if (file_exists($imagePath)) {
                $data['LokasiFile'] = $newImagePath;
            }
        }
        if (Foto::create($data)) {
            return redirect()->to('/'.$slug);
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
