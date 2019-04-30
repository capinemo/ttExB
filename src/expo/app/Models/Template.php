<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    /*
     * Relations
     */
    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'tmpl_id');
    }
}
