<?php

namespace App\Actions;

use App\Models\Content;
use Illuminate\Support\Facades\Validator;

trait ContentRecordService
{
    public function create()
    {
        Validator::make($this->add, [
            'name' => 'required',
            'label' => 'required',
        ])->validate();
        if(isset($this->add['parent_id'])) {
            $parent_id = $this->add['parent_id'];
            $this->add['type'] = 'group';
        }else {
            $parent_id = $this->parent;
            Validator::make($this->add, [
                'type' => 'required',
            ])->validate();
        }

        $record = [
            'name' => $this->add['name'],
            'label' => $this->add['label'],
            'type' => $this->add['type'],
            'value' => null,
            'page' => $this->page,
            'order' => null,
            'parent_id' => (int)$parent_id,
            'status' => 'temp'
        ];

        $record = Content::create($record);
        $record = $record->toArray();
        $record['children'] = [];

        if(isset($this->add['parent_id'])) {
            array_push($this->state[$parent_id]['children'], $record);
        }
        $this->state[$record['id']] = $record;

        foreach($this->state as $key => $item) {
            if(!isset($item['id'])) {
                $this->state[$key]['id'] = $key;
            }
        }

        $this->showGroup($this->parent);

        $this->add = ['open' => false, 'type' => null];
    }

    public function delete($item)
    {
        $parent_id = $this->state[$item]['parent_id'];
        if($parent_id != $this->parent) {
            foreach($this->state[$parent_id]['children'] as $key => $value) {
                if($value['id'] == $item) {
                    unset($this->state[$parent_id]['children'][$key]);
                }
            }
        }
        unset($this->state[$item]);
        $this->confirmDelete = null;
        $this->showGroup($this->parent);
    }
}