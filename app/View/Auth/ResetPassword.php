<?php

namespace App\View\Auth;

use Illuminate\Http\Request;
use Livewire\Component;

class ResetPassword extends Component
{
    private $request;

    public function mount(Request $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        return view('auth.reset-password')->with('request', $this->request)->layout('layouts.auth');
    }
}
