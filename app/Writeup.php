<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writeup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'idea_id','writeup'
    ];

    public function users()
    {
        return $this->belongsTo('App\User','creator_id');
    }
    /**
     * Get the Idea that owns the writeup.
     */
    public function ideas()
    {
        return $this->belongsTo('App\Idea','idea_id');
    }
}
