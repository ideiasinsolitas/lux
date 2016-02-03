<?php

namespace App\Models\Business\ProjectManagement\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Business\ProjectManagement\Ticket\TicketRelationship;

class Ticket extends Model
{
    use SoftDeletes,
        TicketRelationship;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'business_tickets';

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
