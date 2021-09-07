<?php

namespace App\Actions\Seo;

use App\Models\Post;
use App\Models\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

trait Edit
{
    public function editSeo()
    {
        $page = $this->pages->find($this->page['id']);
        $page->page_title = $this->page['page_title'] ?? '';
        $page->seo_title = $this->page['meta_title'] ?? '';
        $page->seo_description = $this->page['meta_description'] ?? '';
        $page->seo_keywords = $this->page['meta_keywords'] ?? '';
        $page->save();

        if(isset($this->page['thumbnail']['upload']) && $this->page['thumbnail']['upload']) {
            if(!is_dir(storage_path() . '/app/public/files/pages/' . $this->page['id'] . '/images/')) {
                mkdir(storage_path() . '/app/public/files/pages/' . $this->page['id'] . '/images/', 0777, true);
            }

            $filename = date('md') . mt_rand(10, 99) . str_shuffle(date("jHi")) . '.jpg';

            $path = 'pages/' . $this->page['id'] . '/images/' . $filename;

            Image::make($this->page['thumbnail']['upload'])->encode('jpg', 75)->save(storage_path('app/public/files/' . $path));

            if(isset($this->page['thumbnail']['id'])) {
                $this->page['thumbnail']['delete'] = true;
                $record = File::find($this->page['thumbnail']['id']);
            }else {
                $record = new File;
            }
            $record->name = $filename;
            $record->path = $path;
            $record->type = 'thumbnail';
            $record->file_type = 'image';
            $record->post_type = 'page';
            $record->post_id = $this->page['id'];
            $record->save();

            if(isset($this->page['thumbnail']['name']) && $this->page['thumbnail']['name']) {
                $this->page['thumbnail']['delete'] = true;
            }
        }

        if(isset($this->page['thumbnail']['delete']) && $this->page['thumbnail']['delete']) {
            if(!isset($this->page['thumbnail']['upload']) || !$this->page['thumbnail']['upload']) {
                File::find($this->page['thumbnail']['id'])->delete();
            }
            @unlink(storage_path('app/public/files/pages/' . $this->page['id'] . '/images/' . $this->page['thumbnail']['name']));
        }

        $this->page = null;

        flashSuccess([
            'title' => 'Změny uloženy',
            'message' => 'Nastavení SEO bylo úspěšně uloženo.',
        ], $this);
    }
}