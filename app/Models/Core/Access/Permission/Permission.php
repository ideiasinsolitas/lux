<?php namespace App\Models\Access\Permission;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\Permission\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Relationship\PermissionRelationship;

/**
 * Class Permission
 * @package App\Models\Access\Permission
 */
class Permission extends Model
{

    use PermissionRelationship, PermissionAttribute;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('access.permissions_table');
    }
}