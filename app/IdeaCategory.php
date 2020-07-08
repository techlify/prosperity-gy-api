<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaCategory extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idea_id', 'category_id', 'creator_id',
    ];
}
