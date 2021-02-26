<?php

namespace App\Actions;

use App\Models\Content;

trait ContentSubmitForm
{
    public function submit()
    {
        Content::fixTree();
        
        if($this->page) {
            $state = Content::where('page', $this->page);
        }
        if($this->group) {
            $state = Content::where('parent_id', $this->group);
        }

        $prev = $state->pluck('id')->toArray();
        $state = $state->get();

        $new = collect($this->state);
        $new = $new->pluck('id')->all();

        $diff = array_diff($prev, $new);

        foreach($this->state as $key => $record) {
            if($state->find($key)) {
                $state->find($key)->setLocale('cs')->update([
                    'label' => $record['label'],
                    'value' => $record['value'],
                    'order' => $record['order'],
                    'status' => 'production',
                ]);
            }else {
                $page = Content::create([
                    'name' => $record['name'],
                    'label' => $record['label'],
                    'value' => $record['value'],
                    'page' => $this->page,
                    'type' => $record['type'],
                    'parent_id' => $record['parent_id'] ?? $this->group,
                    'order' => $record['order'],
                    'status' => 'production',
                ]);
            }
            
        }

        foreach($diff as $id) {
            $state->find($id)->delete();
        }

        dd('done');
    }
}