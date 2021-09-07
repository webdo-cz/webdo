<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['name', 'value']; 
}
