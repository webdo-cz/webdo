<?php

namespace App\View\Auth;

use Livewire\Component;

class VerifyEmail extends Component
{
    private $request;

    public function mount(Request $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        return $this->request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email')->layout('layouts.auth');
    }
}
