<?php

namespace App\Http\Livewire\Eshop\Settings;

use App\Models\Option;
use Livewire\Component;

class Connections extends Component
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
        $this->form['gp_goid'] = config('option.gp_goid');
        $this->form['gp_ClientID'] = config('option.gp_ClientID');
        $this->form['gp_ClientSecret'] = config('option.gp_ClientSecret');
        $this->form['gp_return_url'] = config('option.gp_return_url');
        $this->form['gp_test'] = config('option.gp_test');
    }

    public function render()
    {
        return view('livewire.eshop.settings.connections');
    }
}