<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /*
     * Relations
     */
    public function template()
    {
        return $this->belongsTo(Template::class, 'tmpl_id');
    }

    public function graphs()
    {
        return $this->hasMany(GraphRec::class, 'block_id');
    }

    public function numbers()
    {
        return $this->hasMany(NumberRec::class, 'block_id');
    }
}
