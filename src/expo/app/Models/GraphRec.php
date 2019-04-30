<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraphRec extends Model
{
    /*
     * Relations
     */
    public function block()
    {
        return $this->belongsTo(Template::class, 'block_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
