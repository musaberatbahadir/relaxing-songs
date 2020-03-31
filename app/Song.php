<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = [];

    /**
     * The fans that belong to the song.
     */
    public function fans()
    {
        return $this->belongsToMany('App\User', 'user_song_favorites');
    }

    /**
     * Get the category that owns the song.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
