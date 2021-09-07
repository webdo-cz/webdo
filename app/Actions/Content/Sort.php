<?php

namespace App\Actions\Content;

trait Sort
{
    public function handleSortOrderChange($sortOrder)
    {
        foreach($sortOrder as $key => $item) {
            $this->state[$item['value']]['order'] = 1000-$item['order'];
        }
        $this->dispatchBrowserEvent('textarea-resize');
    }

    public function toJSON() {}
}