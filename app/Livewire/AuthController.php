<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AuthController extends Component
{
    public function index_login()
    {
        return view('livewire.login');
    }
    public function index_register(){
        return view('livewire.register');
    }
    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
    public function login(Request $request)
    {

    $loginField = $request->input('login');
    $password = $request->input('password');

    // Cek apakah login field adalah email atau username
    $field = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $field => $loginField,
        'password' => $password
    ];

    // Lakukan proses autentikasi sesuai dengan field yang dipilih
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->with('errorLogin', 'Username atau password salah');
    }
    
    public function register(Request $request){
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $address = $request->address;

        $user = User::create([
            'NamaLengkap' => $name,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'Alamat' => $address
        ]);
        if ($user) {
            return redirect('/login')->with('successCreateAccount', 'Berhasil membuat akun!');
        } else{
            return redirect('/register')->with('error', 'Gagal membuat akun!');
        }
    }    
}
