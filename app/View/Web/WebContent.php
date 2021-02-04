<?php

namespace App\View\Web;

use App\Models\Content;
use Livewire\Component;

class WebContent extends Component
{
    public $group = null;
    public $groupName = null;
    public $base = [];
    public $groups = [];
    public $groupNames = [];
    public $form = [];

    public function submit() {
        foreach($this->base as $item) {
            if(isset($item['edited']) && $item['edited']) {
                $record = Content::find($item['id']);
                $record->value = $item['value'];
                $record->save();
            }
        }
        foreach($this->groups as $groups) {
            foreach($groups as $group) {
                foreach($group as $item) {
                    if(isset($item['edited']) && $item['edited']) {
                        $record = Content::find($item['id']);
                        $record->value = $item['value'];
                        $record->save();
                    }
                }
            }
        }

        $flash = [
            'type' => 'success',
            'title' => 'Texty upraveny',
            'message' => 'Úpravy byly úspěšně uloženy do databáze',
        ];
        
        flash($flash, $this);

        return redirect('web/web-content');
    }

    public function back() {
        $this->group = null;
        $this->form = $this->base;
    }

    public function showGroup($group, $name) {
        $this->group = $group;
        $this->groupName = $name;
        $this->form = $this->groups[$group][$name];
    }

    public function mount()
    {
        $base = Content::where('group', null)
            ->where('page', 'index')
            ->orderBy('order', 'asc')
            ->get()
            ->keyBy('name')
            ->toArray();
        $groups = Content::where('group', '!=' , null)
            ->where('page', 'index')
            ->orderBy('order', 'asc')
            ->get()
            ->groupBy(['group','child'])
            ->map(function ($pb) { return $pb->map(function ($pb) { return $pb->keyBy('name'); }); })
            ->toArray();
        $groupNames = Content::where('type', 'input')
            ->where('group', '!=' , null)
            ->get()
            ->unique('child')
            ->keyBy('child')
            ->map(function ($pb) { 
                return $pb->value; 
            })->toArray();
        
        foreach($groups as $key => $group) {
            $base[$key]['value'] = $group;
        }
        
        $this->base = $base;
        $this->groups = $groups;
        $this->groupNames = $groupNames;
        $this->form = $base;
    }

    public function render()
    {
        return view('web.content.index')
            ->layout('layouts.app', ['hideSidebar' => true]);
    }
}
