<?php namespace App\Http\Requests\Core\Access\Permission;

use App\Http\Requests\Request;

/**
 * Class UpdatePermissionRequest
 * @package App\Http\Requests\Core\Access\Permission
 */
class UpdatePermissionRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('edit-permissions');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          =>  'required',
            'display_name'  =>  'required',
        ];
    }
}