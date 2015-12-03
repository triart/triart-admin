<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artworker extends Model
{
    protected $table = 'artworker';

    public function arts()
    {
        return $this->hasMany(\App\Models\Art::class);
    }
}