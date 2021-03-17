<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $appends = ['full_path'];
    protected $hidden = ['file_type', 'post_type', 'post_id', 'created_at', 'updated_at'];

    public function getFullPathAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
