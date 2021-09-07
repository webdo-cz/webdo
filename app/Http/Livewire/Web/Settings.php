<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;

class Settings extends Component
{
    public $page;

    public function mount()
    {
        $this->page = request()->page;
        if(!file_exists(__DIR__ . '/Settings/' .  ucfirst($this->page) . '.php')) {
            abort(404);
        }
    }
    
    public function render()
    {
        return view('livewire.web.settings');
    }
}