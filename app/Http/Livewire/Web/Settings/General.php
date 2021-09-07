<?php

namespace App\Http\Livewire\Web\Settings;

use App\Models\Option;
use Livewire\Component;

class General extends Component
{
    public $form;

    public function submit() {
        foreach($this->form as $key => $item) {
            Option::updateOrCreate(
                [
                    'name' => $key,
                ],
                [
                    'value' => $item
                ],
            );
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
        return view('livewire.web.settings.general');
    }
}