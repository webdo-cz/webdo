<?php

namespace App\View\Form;

use App\Models\Post;
use App\Models\Term;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Actions\SubmitPostForm;

class RecordForm extends Component
{
    use WithFileUploads;

    public $section, $parent, $method, $uid = null;

    public $state = [
        'status' => "published",
        'custom_teaser' => false,
    ];

    public $teaser;
    public $galleryUpload;
    public $filesUpload, $fileNameForm;
    public $oneVariant = true, $variantForm = [];

    public $terms;

    public function submit()
    {
        //dd($this->state['custom_teaser']);
        Validator::make($this->state, [
            'title' => 'required',
            'body' => 'required',
        ])->validate();

        if($this->state['custom_teaser']) {
            $this->state['teaser'] = $this->teaser;
        }

        if($this->parent == 'product') {
            if($this->oneVariant) {
                Validator::make($this->variantForm, [
                    'vat' => 'required',
                    'price' => 'required|numeric',
                    'weight' => 'required|numeric',
                    'availability' => 'required',
                    'availabilityE' => 'required',
                ])->validate();
    
                $this->variantForm['name'] = "one-variant";
                $this->variantForm['code'] = $this->state['id'] . "/" . $this->variantForm['name'];
    
                array_push($this->state['variants']['new'], $this->variantForm);
            }
        }

        $helper = new SubmitPostForm();
        $helper->submit([$this->section, $this->parent, $this->method], $this->state);

        return redirect()->to($this->section . '/' . $this->parent . 's');
    }

    public function editVariant($key)
    {
        $this->variantForm = $this->state['variants']['new'][$key];
        $this->variantForm['key'] = $key;
    }

    public function updateVariants($key)
    {
        Validator::make($this->variantForm, [
            'name' => 'required|string|max:255',
            'vat' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'availability' => 'required',
            'availabilityE' => 'required',
        ])->validate();

        foreach($this->state['variants']['new'] as $stateKey => $item) {
            if ($item['name'] == $this->variantForm['name']) {
                if ($stateKey != $key) {
                    $this->addError('price_name', 'Takový název již existuje!');
                    return;
                }
            }
        }

        $this->variantForm['code'] = $this->state['id'] . "/" . $this->variantForm['name'];

        if($key != "add") {
            $this->state['variants']['new'][$key] =  $this->variantForm;
        }else {
            array_push($this->state['variants']['new'], $this->variantForm);
        }
        
        $this->variantForm['name'] = null;
        unset($this->variantForm['key']);
    }

    public function updateFileName($key, $name)
    {
        // $this->validate([
        //     'fileUpload' => 'image|max:4092',
        // ]);

        $newExtension = $pieces = explode(".", $name);
        $newExtension = array_reverse($newExtension);

        $oldExtension = $pieces = explode(".", $this->state['files']['info'][$key]['name']);
        $oldExtension = array_reverse($oldExtension);

        if($newExtension[0] != $oldExtension[0]) {
            $name = $name . "." . $oldExtension[0];
        }

        $this->state['files']['info'][$key]['name'] = $name;
    }

    public function updatedFilesUpload()
    {
        // $this->validate([
        //     'fileUpload' => 'image|max:4092',
        // ]);

        $info = [
            'name' => $this->filesUpload->getClientOriginalName(),
            'size' => number_format(($this->filesUpload->getSize() / 1048576.2), 1, '.', '') . " MB",
        ];
        
        array_push($this->state['files']['new'], $this->filesUpload);
        array_push($this->state['files']['info'], $info);
    }

    public function updatedGalleryUpload()
    {
        $this->validate([
            'galleryUpload' => 'image|max:4092',
        ]);
        array_push($this->state['gallery']['new'], $this->galleryUpload);
    }

    public function removeFrom($i, $type = null) {
        switch ($type) {
            case 'gallery':
                unset($this->state['gallery']['new'][$i]);
                break;
            case 'prevGallery':
                unset($this->state['gallery']['prev'][$i]);
                break;
            case 'files':
                unset($this->state['files']['new'][$i]);
                break;
            case 'prevFiles':
                unset($this->state['files']['prev'][$i]);
                break;
            case 'variants':
                unset($this->state['variants']['new'][$i]);
                break;
            case 'prevVariants':
                unset($this->state['variants']['prev'][$i]);
                break;
        }
    }
    
    public function mount()
    {
        $this->terms = Term::where('post_type', $this->parent)->get();

        if($this->method == "edit-record") {
            $state = Post::findOrFail($this->uid);
            $this->state = $state->toArray();
            if($state->custom_teaser) {
                $this->teaser = $state->teaser;
            }
            $this->state['gallery'] = [
                'prev' => $state->files->where('type', 'gallery')->toArray(),
                'new' => [],
            ];
            $this->state['files'] = [
                'prev' => $state->files->where('type', 'files')->toArray(),
                'new' => [],
                'info' => [],
            ];
            $this->state['variants'] = [
                'prev' => [],
                'new' => [],
            ];

            $prevStaticThumbnail = $state->files->where('type', 'thumbnail')->first();
            $prevHoverThumbnail = $state->files->where('type', 'hover-thumbnail')->first();
            if(isset($prevStaticThumbnail)) {
                $this->state['thumbnail']['prev-static'] = $prevStaticThumbnail->toArray();
            }
            if(isset($prevHoverThumbnail)) {
                $this->state['thumbnail']['prev-hover'] = $prevHoverThumbnail->toArray();
            }

            $this->state['terms'] = $state->terms->pluck('id')->toArray();

            if ($this->parent == 'product') {
                $variantForm = $state->variants->first();
                if($variantForm->name != "one-variant") {
                    $this->oneVariant = false;
                    $this->state['variants']['prev'] = $state->variants->toArray();
                }
    
                $this->variantForm['price'] = $variantForm->price_include_VAT;
                $this->variantForm['vat'] = $variantForm->VAT_rate;
                $this->variantForm['weight'] = $variantForm->weight;
                $this->variantForm['availability'] = $variantForm->availability;
                $this->variantForm['availabilityE'] = $variantForm->availability_empty;
            }
        }else {
            $this->state['id'] = strtoupper(Str::random(4)) . str_shuffle(date("jmi"));
            $this->state['gallery'] = [
                'prev' => [],
                'new' => [],
            ];
            $this->state['files'] = [
                'prev' => [],
                'new' => [],
                'info' => [],
            ];
            $this->state['variants'] = [
                'prev' => [],
                'new' => [],
            ];
            $this->state['thumbnail'] = [];
            $this->state['terms'] = [];
        }
    }

    public function render()
    {
        return view('form.record-form');
    }
}
