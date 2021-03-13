<?php

namespace App\View\Web\Settings;

use App\Models\Option;
use Livewire\Component;

class General extends Component
{
    public $form;

    public function submit() {
        $options = Option::where('group', null)->get();
        foreach($this->form as $key => $item) {
            $options->where('name', $key)->first()
                ->update(['value' => $item]);
        }

        $flash = [
            'type' => 'success',
            'title' => 'Nastevní uloženo',
            'message' => 'Nastavení bylo úspěšně uloženo.',
        ];

        flash($flash , $this);
    }

    public function mount() {
        $this->form['app_name'] = config('option.app_name');
        $this->form['frontend_url'] = config('option.frontend_url');
    }

    public function render()
    {
        return view('web.settings.general');
    }
}