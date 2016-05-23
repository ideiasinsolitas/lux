<?php

namespace App\Models\Publishing\ContentManagement;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use Nodeable,
        Likeable,
        Votable,
        Commentable,
        OwnerTaggable,
        Collaborative,
        Ownable;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'publishing_contents';

    /**
     * The attributes that are not mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;
}
