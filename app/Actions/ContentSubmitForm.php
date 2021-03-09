<?php

namespace App\Actions;

use App\Models\Content;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

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

            if(isset($record['delete'])) {
                foreach($record['delete'] as $lang => $condition) {
                    if($condition && file_exists(storage_path('app/public/files/' . $record['value'][$lang]))) {
                        unlink(storage_path('app/public/files/' . $record['value'][$lang]));
                        $record['value'][$lang] = null;
                    }
                    
                }
            }

            if(isset($record['upload'])) {
                foreach($record['upload'] as $lang => $image) {
                    if(!is_dir(storage_path() . '/app/public/files/content/images/')) {
                        mkdir(storage_path() . '/app/public/files/content/images/', 0777, true);
                    }
    
                    if(isset($record['value'][$lang]) && $record['value'][$lang] && file_exists('app/public/files/' . $record['value'][$lang])) {
                        unlink(storage_path('app/public/files/' . $record['value'][$lang]));
                    }
    
                    if(isset($record['filename'])) {
                        $filename = $record['filename'];
                    }else {
                        $filename = $record['id'] . date('md') . mt_rand(10, 99) . str_shuffle(date("jHi")) . '.jpg';
                    }
    
                    $path = 'content/images/' . $filename;
            
                    Image::make($image)->encode('jpg', 75)->save(storage_path('app/public/files/' . $path));

                    $record['value'][$lang] = $path;
                }
            }

            if($state->find($key)) {
                $state->find($key)->update([
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

        $this->dispatchBrowserEvent('submitted');
    }
}