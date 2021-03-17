<?php

namespace App\View\Web;

use App\Models\Post;
use App\Models\File;

use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

use Livewire\WithFileUploads;
use Livewire\Component;

class Pages extends Component
{
    use WithFileUploads;

    public $page;
    public $pages;

    public function submit()
    {
        $page = $this->pages->find($this->page['id']);
        $page->page_title = $this->page['page_title'] ?? '';
        $page->meta_title = $this->page['meta_title'] ?? '';
        $page->meta_description = $this->page['meta_description'] ?? '';
        $page->meta_keywords = $this->page['meta_keywords'] ?? '';
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

        $flash = [
            'type' => 'success',
            'title' => 'Úspěšně uloženo!',
            'message' => 'Nastavení SEO bylo úspěšně uloženo.',
        ];
        
        flash($flash, $this);
    }

    public function show($id)
    {
        $this->page = $this->pages->find($id);
        $this->page->thumbnail = $this->page->files->where('type', 'thumbnail')->first();
        $this->page = $this->page->toArray();
    }

    public function mount()
    {
        $this->pages = Post::where('type', 'page')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('web.pages');
    }
}