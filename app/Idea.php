<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'idea',
    ];

    public function users()
    {
        return $this->belongsTo('App\User','creator_id');
    }

}
