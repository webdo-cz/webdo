<?php

namespace App\Actions\Content;

use App\Models\Content;
use Illuminate\Support\Facades\Validator;

trait Create
{
    public function createElement($form)
    {
        
        Validator::make($form, [
            'name' => 'required',
            'label' => 'required',
            'type' => 'required',
        ])->validate();

        $record = [
            'name' => $form['name'],
            'label' => $form['label'],
            'type' => $form['type'],
            'value' => null,
            'page' => 'index',
            'order' => null,
            'parent_id' => (int)$this->group,
            'status' => 'temp',
            'version_id' => (int)$this->version->id,
        ];

        $record = Content::create($record);
        $record = $record->toArray();

        $this->state[$record['id']] = $record;

        flashSuccess([
            'title' => 'Element byl přidán!',
            'message' => 'Nový element byl úspěšně přidán.',
        ], $this);

        $this->dispatchBrowserEvent('closemodal');
    }

    public function createGroup($form)
    {
        
        Validator::make($form, [
            'label' => 'required'
        ])->validate();

        $max = collect($this->state)->where('parent_id', $this->group)->pluck('name')->max();

        $record = [
            'name' => $max+1,
            'label' => $form['label'],
            'type' => 'group',
            'value' => null,
            'page' => 'index',
            'parent_id' => (int)$this->group,
            'order' => null,
            'status' => 'temp'
        ];

        $record = Content::create($record);
        $record = $record->toArray(['id','type','name','label','value','parent_id','order','status']);

        $this->state[$record['id']] = $record;

        flashSuccess([
            'title' => 'Element byl přidán!',
            'message' => 'Nový element byl úspěšně přidán.',
        ], $this);

        $this->dispatchBrowserEvent('closemodal');
    }
}