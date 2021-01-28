<?php

namespace App\View\Auth;

use Livewire\Component;

class ConfirmPassword extends Component
{
    public function render()
    {
        return view('auth.confirm-password')->layout('layouts.auth');
    }
}
