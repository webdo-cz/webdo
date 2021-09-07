<?php

namespace App\Actions\Content;

use App\Models\Content;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

trait Submit
{
    public function submit() 
    {
        foreach($this->state as $element) {

            if($element['delete'] ?? false) {
                if($element['type'] == 'image' && file_exists(storage_path('app/public/files/' . $element['value'][$lang]))) {
                    unlink(storage_path('app/public/files/' . $element['value'][$lang]));
                }
                Content::find($element['id'])->delete();
                unset($this->state[$element['id']]);
            }

            if($element['delete-file'] ?? false) {
                foreach($element['delete-file'] as $lang => $condition) {
                    if($condition && file_exists(storage_path('app/public/files/' . $element['value'][$lang]))) {
                        unlink(storage_path('app/public/files/' . $element['value'][$lang]));
                        $element['value'][$lang] = null;
                        $this->state[$element['id']]['value'][$lang] = null;
                        $this->state[$element['id']]['delete-file'][$lang] = false;
                    }
                }
            }

            if($element['upload'] ?? false) {
                foreach($element['upload'] as $lang => $image) {
                    if($image) {
                        if(!is_dir(storage_path() . '/app/public/files/content/images/')) {
                            mkdir(storage_path() . '/app/public/files/content/images/', 0777, true);
                        }
        
                        if(isset($element['value'][$lang]) && $element['value'][$lang] && file_exists('app/public/files/' . $element['value'][$lang])) {
                            unlink(storage_path('app/public/files/' . $element['value'][$lang]));
                        }
        
                        if(isset($element['filename'])) {
                            $filename = $element['filename'];
                        }else {
                            $filename = $element['id'] . date('md') . mt_rand(10, 99) . str_shuffle(date("jHi"));
                        }
                        if($image->getClientOriginalExtension() == 'png') {
                            $extension = 'png';
                        }else {
                            $extension = 'jpg';
                        }
        
                        $path = 'content/images/' . $filename . '.' . $extension;
                
                        Image::make($image)->encode($extension, 75)->save(storage_path('app/public/files/' . $path));
    
                        $element['value'][$lang] = $path;
                        $this->state[$element['id']]['value'][$lang] = $path;
                        unset($this->state[$element['id']]['upload'][$lang]);
                    }
                }
            }

            $element['status'] = 'production';

            Content::find($element['id'])->update($element);
        }

        flashSuccess([
            'title' => 'Změny uloženy',
            'message' => 'Všechny změny byly úspěšně uloženy',
        ], $this);
    }
}