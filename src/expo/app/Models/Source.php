<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /*
     * Relations
     */
    public function templates()
    {
        return $this->hasMany(Template::class, 'source_id');
    }

    public function graphs()
    {
        return $this->hasMany(GraphRec::class, 'source_id');
    }

    public function numbers()
    {
        return $this->hasMany(NumberRec::class, 'source_id');
    }
}
