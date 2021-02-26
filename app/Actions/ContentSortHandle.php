<?php

namespace App\Actions;

trait ContentSortHandle
{
    public function handleSortOrderChange($sortOrder)
    {
        $this->form = $sortOrder;
        $sortOrder = array_reverse($sortOrder);
        foreach($sortOrder as $key => $item) {
            $this->state[$item]['order'] = $key+1;
        }
    }

    public function handleChildrenSortOrderChange($sortOrder)
    {
        if(!empty($sortOrder)) {
            $children = [];
            $sortOrder = array_reverse($sortOrder);
            foreach($sortOrder as $key => $item) {
                $this->state[$item]['order'] = $key+1;
                array_push($children, $this->state[$item]);
            }
            $this->state[$children[0]['parent_id']]['children'] = $children;
        }
    }

    public function toJSON()
    {

    }
}