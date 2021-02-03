<?php

namespace App\View\User;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $changePassword = [];

    public function changePassword() {
        
        Validator::extend('old_password', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });

        Validator::make($this->changePassword, [
            'old_password' => 'required|old_password',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ],[
            'old_password' => 'Heslo se neshoduje se současným heslem',
        ])->validate();

        $this->user->password = Hash::make($this->changePassword['password']);
        $this->user->save();

        $this->changePassword = [];
    }

    public function mount()
    {
        $this->user = Auth::user();
    }
    
    public function render()
    {
        return view('user.profile');
    }
}