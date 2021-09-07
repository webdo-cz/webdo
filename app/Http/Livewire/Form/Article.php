<?php

namespace App\Http\Livewire\Form;

use App\Actions\Form\Init;
use App\Actions\Form\Files;
use App\Actions\Form\Submit;

use Livewire\WithFileUploads;
use Livewire\Component;

class Article extends Component
{
    use WithFileUploads;
    use Init, Files, Submit;

    public $method, $uid = null;
    public $type = 'article';
    public $section = 'web';

    public $lang = 'cs';

    public function mount()
    {
        $this->init();
    }

    public function render()
    {
        return view('livewire.form.article')->layout('layouts.app', ['fullscreen' => true,]);
    }
}
