<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $photo;
    public $imageUpload;
    public $name;
    public $username;
    public $email;
    public $address;

    public function render()
    {
        return view('livewire.settings',[
            'image' => auth()->user()->Foto
        ]);
    }
    public function mount(){
        $this->name = auth()->user()->NamaLengkap;
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->address = auth()->user()->Alamat;
        $this->photo = auth()->user()->Foto;
    }
    public function resetInput(){
        $this->mount([
            $this->imageUpload = null,
        ]);
    }
    public function updated($name, $value){
        $this->resetValidation($name);
        $this->resetErrorBag($name);
    }
    public function update(){
        $user = User::where('UserID', auth()->user()->UserID)->first();
        $validated = $this->validate([
            'imageUpload' => 'nullable|image|max:2024',
            'name' => 'required',
            'username' => [
                'required',
                'min:5',
                Rule::unique('users')->ignore($user->UserID, 'UserID'),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->UserID, 'UserID'),
            ],
            'address' => 'required',
        ],[
            'name.required' => 'Nama Tidak boleh Kosong',
            'username.required' => 'Username tidak boleh Kosong',
            'username.min' => 'Username minimal 5 karakter',
            'username.unique' => 'Username ini sudah digunakan',
            'email.required' => 'Email tidak boleh Kosong',
            'email.email' => 'Masukkan Email yang benar',
            'email.unique' => 'Email ini sudah digunakan',
            'address.required' => 'Alamat tidak boleh Kosong',
        ]);
        if ($user) {
            $data = [
                'NamaLengkap' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'Alamat' => $this->address,
                'Foto' => $this->photo,
            ];
            if ($this->imageUpload && $this->imageUpload->isValid()) {
                if (file_exists(public_path('storage/' . $user->Foto))) {
                    unlink(public_path('storage/' . $user->Foto));
                }
                $newImagePath = $this->imageUpload->store('image/user/'. $user->UserID . '/profile', 'public');
                $imagePath = storage_path('app/public/' . $newImagePath);
    
                if (file_exists($imagePath)) {
                    $data['Foto'] = $newImagePath;
                }
            }
            if ($user->update($data)) {
                $this->dispatch('updateSuccess', type: 'success', title: 'Operasi Berhasil', message: 'Berhasil memperbarui pengaturan akun');
            } else {
                $this->dispatch('updateFailed', type: 'error', title: 'Ada yang salah', message: 'Gagal memperbarui pengaturan akun');
            }
        }
    }    
}
