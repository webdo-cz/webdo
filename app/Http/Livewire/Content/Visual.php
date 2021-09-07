<?php

namespace App\Http\Livewire\Content;

use App\Models\Post;
use App\Models\Content;
use App\Models\ContentVersion;

use App\Actions\Content\Sort;
use App\Actions\Content\Create;
use App\Actions\Content\Submit;

use Livewire\WithFileUploads;
use Livewire\Component;

class Visual extends Component
{
    use WithFileUploads;
    use Sort, Create, Submit;

    public $post, $version;

    public $developer = false;
    public $group = null;
    public $lang = 'cs';
    public $modal;

    public $state = [];

    public function mount($post, $version)
    {
        $this->post = Post::findOrFail($post);
        $this->version = $this->post->contentVersions()->findOrFail($version);

        $this->state = Content::where('version_id', $this->version->id)->where('status', 'production')->get(['id','type','name','label','value','parent_id','order'])->keyBy('id')->toArray();
    }

    public function render()
    {
        return view('livewire.content.visual')->layout('layouts.app', ['fullscreen' => true,]);
    }
}