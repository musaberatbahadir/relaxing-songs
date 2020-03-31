<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /**
     * Get the songs for the category.
     */
    public function songs()
    {
        return $this->hasMany('App\Song');
    }
}
