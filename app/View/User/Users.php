<?php

namespace App\View\User;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;
    public $user;
    public $confirmUserDelete;

    public function confirmUserDelete($id)
    {
        $this->confirmUserDelete = $id;
    }

    public function deleteUser($id)
    {
        $this->users->find($id)->delete();
        $this->user = null;
        $this->confirmUserDelete = false;
        $this->users = User::orderBy('created_at', 'desc')->get();
    }

    public function showUser($id)
    {
        $this->user = $this->users->find($id);
    }

    public function closeUser()
    {
        $this->user = null;
    }

    public function mount()
    {
        $this->users = User::orderBy('created_at', 'desc')->get();
    }
    
    public function render()
    {
        return view('user.list');
    }
}