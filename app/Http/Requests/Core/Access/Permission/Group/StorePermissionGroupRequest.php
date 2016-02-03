<?php namespace App\Http\Requests\Core\Access\Permission\Group;

use App\Http\Requests\Request;

/**
 * Class StorePermissionGroupRequest
 * @package App\Http\Requests\Core\Access\Permission\Group
 */
class StorePermissionGroupRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('create-permission-groups');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:permission_groups',
        ];
    }
}
