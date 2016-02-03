<?php namespace App\Http\Requests\Core\Access\Role;

use App\Http\Requests\Request;

/**
 * Class EditRoleRequest
 * @package App\Http\Requests\Core\Access\Role
 */
class EditRoleRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('edit-roles');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
