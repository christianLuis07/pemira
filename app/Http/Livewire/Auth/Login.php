<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email_or_username = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email_or_username' => ['required'],
        'password' => ['required'],
    ];

    protected $messages = [
        'email_or_username.required' => 'Email tidak boleh kosong.',
        'password.required' => 'Password tidak boleh kosong.',
    ];

    public function authenticate()
    {
        $this->validate();

        $fieldType = filter_var($this->email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt([$fieldType => $this->email_or_username, 'password' => $this->password], $this->remember)) {
            $this->addError('email_or_username', 'Email atau password salah.');

            return;
        }

        $user = Auth::user();
        if ($user->hasRole('admin')) {
            // dd('admin');
            return redirect()->intended(route('admin.dashboard').'/');
        }elseif ($user->hasRole('user')) {

            return redirect()->intended(route('pemilih.dashboard').'/');
        }else{
            // dd('else');
            return redirect()->route('home');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
