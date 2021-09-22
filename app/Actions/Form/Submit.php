<?php

namespace App\Actions\Form;

use App\Models\Post;
use App\Models\File;
use App\Models\Eshop\ProductVariant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Crawler;
use Auth;

trait Submit
{
    public function submit() 
    {
        Validator::make($this->state, [
            'title' => 'required',
            'body' => 'required',
        ])->validate();

        $this->state['teaser'] = [];

        if($this->state['custom_teaser']) {
            $this->state['teaser'] = $this->teaser;
        }else {
            foreach($this->state['body'] as $lang => $body) {
                $this->state['teaser'][$lang] = substr(strip_tags(str_replace('<br>', ' ', $body)), 0, 200);
            }
        }

        if($this->method == 'edit') {
            $record = Post::findOrFail($this->state['id']);
        }else {
            $record = new Post;
        }
        $record->id = $this->state['id'];
        $record->type = $this->type;
        $record->title = $this->state['title'];
        $record->teaser = $this->state['teaser'] ?? null;
        $record->custom_teaser = $this->state['custom_teaser'];
        $record->body = $this->state['body'];
        $record->status = $this->state['status'];
        $record->slug = $this->getSlugs();

        $record->page_title = $this->state['page_title'] ?? null;
        $record->seo_title = $this->state['meta_title'] ?? null;
        $record->seo_description = $this->state['meta_description'] ?? null;
        $record->seo_keywords = $this->state['meta_keywords'] ?? null;
        
        if(isset($this->state['published_at']) && $this->state['published_at'] != null) {
            $record->published_at = $this->state['published_at'];
        }else {
            $record->published_at = now();
        }

        if($this->method == "create") {
            $record->user_id = Auth::id();
        }

        $dom = new Crawler($record->body);
        $images = $dom->filterXPath('//img')->extract(['src']); 
         
        foreach ($images as $key => $image) {
            if (strpos($image, 'base64') !== false) {
                $file = explode(',', $image);
                $savedBodyImage = $this->saveImage(base64_decode($file[1]), 'post-body', 'image', true);
                $record->body = str_replace($image, asset('storage/' . $savedBodyImage), $record->body);
            }else {
                if(!str_contains($image, env('APP_URL'))) {
                    $savedBodyImage = $this->saveImage($image, 'post-body', 'image', true);
                    $record->body = str_replace($image, asset('storage/' . $savedBodyImage), $record->body);
                }
            }
        }

        $record->save();

        $record->terms()->sync($this->state['terms']);

        if($this->state['thumbnail']['static'] ?? false){
            $this->saveImage($this->state['thumbnail']['static'], 'thumbnail', 'image', true);
            if(isset($this->state['thumbnail']['prev-static'])) $this->state['thumbnail']['prev-static']['delete'] = true;
        }

        if($this->state['thumbnail']['hover'] ?? false){
            $this->saveImage($this->state['thumbnail']['hover'], 'hover-thumbnail', 'image', true);
            if(isset($this->state['thumbnail']['prev-hover'])) $this->state['thumbnail']['prev-hover']['delete'] = true;
        }

        foreach($this->upload['gallery'] as $key => $image) {
            if($image) $this->saveImage($image, 'gallery', 'image', true, $key);
        }
        foreach($this->upload['files'] as $key => $file) {
            if($file) $this->saveFile($image, 'files', 'file', true, $key);
        }

        if($this->method == "edit") {
            if($this->state['thumbnail']['prev-static']['delete'] ?? false){
                $this->deleteFile($this->state['thumbnail']['prev-static']);
            }
            if($this->state['thumbnail']['prev-hover']['delete'] ?? false){
                $this->deleteFile($this->state['thumbnail']['prev-hover']);
            }
            foreach(collect(array_merge($this->state['gallery'], $this->state['files']))->where('delete', true) as $file) {
                $this->deleteFile($file);
            }
        }

        if(isset($this->oneVariant)) {
            if($this->oneVariant) {
                Validator::make($this->state['variant'], [
                    'VAT' => 'required',
                    'price' => 'required|numeric',
                    'buy_price' => 'required|numeric',
                    'availability' => 'required',
                    'availability_empty' => 'required',
                ])->validate();
                $this->state['variant']['product_id'] = $this->state['id'];
                $this->state['variant']['name'] = 'one-variant';
                ProductVariant::updateOrCreate([
                    'id' => $this->state['variant']['id'] ?? false,
                ], $this->state['variant']);
            }else {
                foreach($this->state['variants'] as $variant) {
                    if(isset($variant['key'])) {
                        unset($variant['key']);
                    }
                    $variant['product_id'] = $this->state['id'];
                    ProductVariant::updateOrCreate([
                        'id' => $variant['id'] ?? false,
                    ], $variant);
                }
            }
        }

        flashSuccess([
            'title' => 'Příspěvek vytvořen',
            'message' => 'Nový příspěvek byl úspěšně vytvořen',
        ]);

        return redirect()->to($this->section . '/' . $this->type . 's');
    }

    public function getSlugs()
    {
        $slugs = [];
        foreach($this->state['title'] as $lang => $title) {
            if($this->state['slug'][$lang] ?? false) {
                $slugs[$lang] = Str::slug($this->state['slug'][$lang]);
            }else {
                $slugs[$lang] = Str::slug($this->state['title'][$lang]);
            }
        }
        return $slugs;
    }
}