<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'idea_id', 'rating','text',
    ];
    public function users()
    {
        return $this->belongsTo('App\User','creator_id');
    }
    public function ideas()
    {
        return $this->belongsTo('App\Idea','idea_id');
    }
}
