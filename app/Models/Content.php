<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasTranslations;
    use NodeTrait;

    //protected $table = "content";
    
    protected $fillable = [
        'name',
        'label',
        'value',
        'page',
        'type',
        'parent_id',
        'version_id',
        'order',
        'status',
    ]; 

    public $translatable = ['value'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

}
