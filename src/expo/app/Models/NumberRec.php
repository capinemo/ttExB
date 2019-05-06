<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberRec extends Model
{
    public $timestamps = false;

    /*
     * Relations
     */
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
