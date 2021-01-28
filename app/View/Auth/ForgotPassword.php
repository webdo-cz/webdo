<?php

namespace App\View\Auth;

use Livewire\Component;

class ForgotPassword extends Component
{
    public function render()
    {
        return view('auth.forgot-password')->layout('layouts.auth');
    }
}
