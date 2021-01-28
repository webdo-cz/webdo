<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\File;
use App\Models\Eshop\Variant;
use Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

class SubmitPostForm
{
    public $section, $parent, $method;
    public $publicPath, $storagePath;

    public $state;
    public $fileNumber = 0, $fileName;
    
    public function submit($details, $state)
    {
        $this->section = $details[0];
        $this->parent = $details[1];
        $this->method = $details[2];
        $this->state = $state;

        $this->fileName = str_shuffle(date("jmi")) . substr($this->parent, 0, 2);

        $this->publicPath = 'files/' . $state['id'] . '/';
        $this->storagePath = storage_path() . '/app/public/' . $this->publicPath;

        $record = $this->startRecord();
        $record->id = $state['id'];
        $record->type = $this->parent;
        $record->title = $state['title'];
        $record->teaser = $state['teaser'];
        $record->custom_teaser = $state['custom_teaser'];
        $record->body = $state['body'];
        $record->status = $state['status'];
        if(isset($state['slug']) && $state['slug'] != null) {
            $record->slug = Str::slug($state['slug']);
        }else {
            $record->slug = Str::slug($state['title']);
        }
        if(isset($state['published_at']) && $state['published_at'] != null) {
            $record->published_at = $state['published_at'];
        }else {
            $record->published_at = now();
        }

        if($this->method == "add-record") {
            $record->user_id = Auth::id();
        }
        $record->save();

        $record->terms()->sync($state['terms']);

        if($this->method == "edit-record") {
            $files = array_merge(array_column($state['files']['prev'], 'id'), array_column($state['gallery']['prev'], 'id'));
            if(isset($state['thumbnail']['prev-static']['id'])) {
                array_push($files, $state['thumbnail']['prev-static']['id']);
            }
            if(isset($state['thumbnail']['prev-hover']['id'])) {
                array_push($files, $state['thumbnail']['prev-hover']['id']);
            }
            $dbFiles = File::where('post_id', $state['id'])->whereNotIn('id', $files)->get();
            foreach($dbFiles as $file) {
                unlink(storage_path('app/public/' . $file->path));
                $file->delete();
            }
        }

        if(isset($state['thumbnail']['static']) && $state['thumbnail']['static'] != null) {
            $this->uploadImage($state['thumbnail']['static'], 'thumbnail');
        }

        if(isset($state['thumbnail']['hover']) && $state['thumbnail']['hover'] != null) {
            $this->uploadImage($state['thumbnail']['hover'], 'hover-thumbnail');
        }

        foreach($state['gallery']['new'] as $image) {
            $this->uploadImage($image, 'gallery');
        }

        foreach($state['files']['new'] as $key => $file) {
            $info = $state['files']['info'][$key];
            $this->uploadFile($file, $info['name'], 'files');
        }

        foreach($state['variants']['new'] as $key => $item) {
            $record = new Variant;
            $record->name = $item['name'];
            $record->price = (float)((int)$item['price'] / ((int)$item['vat'] + 100) * 100);
            $record->price_include_VAT = (float)$item['price'];
            $record->VAT_rate = $item['vat'];
            $record->weight = $item['weight'];
            $record->availability = $item['availability'];
            $record->availability_empty = $item['availabilityE'];
            $record->active = 1;
            $record->product_id = $state['id'];
            $record->save();
        }
    }

    private function startRecord()
    {
        if($this->method == 'edit-record') {
            return Post::findOrFail($this->state['id']);
        }else {
            return new Post;
        }
    }

    private function uploadImage($image, $type)
    {

        if(!is_dir($this->storagePath . 'images/')) {
            mkdir($this->storagePath . 'images/', 0777, true);
        }

        $path = 'images/' . $this->fileNumber . '-' . $this->fileName . '-' . strtoupper(substr($type, 0, 3)) . Str::random(6) . '.jpg';

        Image::make($image)->encode('jpg', 75)->save($this->storagePath . $path);

        if($type != 'body') {
            $record = new File;
            $record->path = $this->publicPath . $path;
            $record->type = $type;
            $record->file_type = 'image';
            $record->post_type = $this->parent;
            $record->post_id = $this->state['id'];
            $record->save();
        }else {
            $this->body = str_replace($image, $this->publicPath . $path, $this->body);
        }

        $this->fileNumber++;
    }

    private function uploadFile($file, $name, $type)
    {

        if(!is_dir($this->storagePath . 'files/')) {
            mkdir($this->storagePath . 'files/', 0777, true);
        }

        $file->storeAs($this->publicPath . 'files/' , $name, 'public');
            
        $record = new File;
        $record->path = $this->publicPath . 'files/' . $name;
        $record->type = $type;
        $record->file_type = 'file';
        $record->post_type = $this->parent;
        $record->post_id = $this->state['id'];
        $record->save();
    }
}
