<?php

namespace App\Http\Livewire\Web;

use App\Models\Post;
use App\Models\ContentVersion;

use App\Actions\Page\Create;
use App\Actions\Seo\Edit as EditSeo;
use Livewire\WithFileUploads;

use Livewire\Component;

class Pages extends Component
{
    use WithFileUploads;
    use EditSeo, Create;

    public $create = [];
    public $page;
    public $pages, $components;

    public function show($id)
    {
        $this->page = $this->pages->find($id);
        $this->page->thumbnail = $this->page->files->where('type', 'thumbnail')->first();
        $this->page = $this->page->toArray();
    }

    public function mount()
    {
        $this->pages = Post::where('type', 'page')->orderBy('created_at')->get();
        $this->components = Post::where('type', 'component')->orderBy('created_at')->get();
    }

    public function render()
    {
        return view('livewire.web.pages');
    }
}