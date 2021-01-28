<?php

namespace App\View\Auth;

use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('auth.login')->layout('layouts.auth');
    }
}
