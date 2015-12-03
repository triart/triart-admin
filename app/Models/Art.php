<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $table = 'art';

    public function artworker()
    {
        return $this->belongsTo(\App\Models\Artworker::class);
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class);
    }

}