<?php

namespace App\Http\Livewire\Form;

use App\Actions\Form\Init;
use App\Actions\Form\Files;
use App\Actions\Form\Submit;

use Illuminate\Support\Facades\Validator;

use Livewire\WithFileUploads;
use Livewire\Component;

class Product extends Component
{
    use WithFileUploads;
    use Init, Files, Submit;

    public $method, $uid = null;
    public $type = 'product';
    public $section = 'eshop';

    public $lang = 'cs';

    public $oneVariant = false;

    public function addVariant($form) 
    {
        Validator::make($form, [
            'name' => 'required|string|max:255',
            'VAT' => 'required',
            'price' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'availability' => 'required',
            'availability_empty' => 'required',
        ])->validate();

        if(isset($form['key'])) {
            $this->state['variants'][$form['key']] = $form;

            flashSuccess([
                'title' => 'Varianta upravena',
                'message' => 'Varianta byla upravena!',
            ], $this);

            return 'edited';
        }else {
            array_push($this->state['variants'], $form);

            flashSuccess([
                'title' => 'Varianta přidána',
                'message' => 'Nová varianta byla přidána!',
            ], $this);

            return 'added';
        }

        
    }

    public function mount()
    {
        $this->init();
        if($this->state['variant'] ?? false) $this->oneVariant = true;
        if(!isset($this->state['variant'])) $this->state['variant'] = [];
        if(!isset($this->state['variants'])) $this->state['variants'] = [];
    }

    public function render()
    {
        return view('livewire.form.product')->layout('layouts.app', ['fullscreen' => true,]);
    }
}
