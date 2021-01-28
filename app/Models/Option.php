<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $hidden = ['id', 'group', 'type', 'updated_at'];
}
