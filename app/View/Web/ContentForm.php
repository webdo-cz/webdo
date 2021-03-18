<?php

namespace App\View\Web;

use App\Models\Content;
use Illuminate\Support\Facades\Validator;

use App\Actions\ContentSortHandle;
use App\Actions\ContentRecordService;
use App\Actions\ContentSubmitForm;

use Livewire\WithFileUploads;
use Livewire\Component;

class ContentForm extends Component
{
    use ContentSortHandle, ContentRecordService, ContentSubmitForm;
    use WithFileUploads;

    public $iframe = null;

    public $modal = [
        'id' => null,
        'type' => null,
        'value' => null,
    ];

    public $confirmClose = null;
    public $confirmDelete = null;
    
    public $developer = false;

    public $lang = 'cs';
    public $page, $group;

    public $state, $form;

    public $parent;

    public $add = ['open' => false, 'type' => null];

    public function closeModal() {
        $this->modal = [
            'id' => null,
            'type' => null,
            'value' => false,
        ];
    }

    public function openModal($id) {
        $modal = $this->state[$id];
        $this->modal = [
            'id' => $modal['id'],
            'type' => $modal['type'],
            'value' => isset($modal['value'][$this->lang]) ? $modal['value'][$this->lang] : null,
        ];
    }

    public function uploadImage($id, $file, $load, $error, $progress) {
        $this->upload('state.' . $id . '.upload.'. $this->lang, $file, $load, $error, $progress);
    }

    public function back() {
        $id = $this->state[$this->parent]['parent_id'];
        $id = $this->state[$id]['parent_id'];
        $this->showGroup($id);
    }

    public function showGroup($id) {
        $this->parent = $id;
        $form = collect($this->state);
        $this->form = $form->where('parent_id', $id)->sortByDesc('order')->pluck('id')->all();
    }

    public function mount()
    {
        $this->iframe = config('option.frontend_url');
        if(request()->lang) $this->lang = request()->lang;

        $state = Content::usingLocale($this->lang)->where('status', 'production');

        if(request()->page) {
            $state = $state->where('page', request()->page);
            $this->page = request()->page;
        }
        if(request()->group) {
            $state = $state->where('parent_id', request()->group);
            $this->group = request()->group;
        }

        $this->state = $state->with('children')->get()->keyBy('id')->toArray();

        if(request()->group) {
            $this->showGroup(request()->group);
        }else {
            $this->showGroup(null);
        }
    }
    
    public function render()
    {
        return view('web.content.index')->layout('layouts.app', ['fullscreen' => true,]);;
    }
}
