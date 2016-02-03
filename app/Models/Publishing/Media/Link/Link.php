<?php

namespace App\Models\Publishing\Media\Link;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Publishing\Media\Link\Relationship\LinkRelationship;

class Link extends Model
{
    use SoftDeletes,
        LinkRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'publishing_links';

    /**
     * For soft deletes
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are not mass assignable.
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    // public $timestamps = false;

    /**
     * The storage format of the model's date columns.
     * @var string
     */
    // protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    // protected $fillable = [];

    /**
     * The connection name for the model.
     *
     * @var string
     */
    // protected $connection = 'connection-name';
}
