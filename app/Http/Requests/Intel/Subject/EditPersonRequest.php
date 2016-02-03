<?php namespace App\Http\Requests\Core\People;

use App\Http\Requests\Request;

/**
 * Class EditUserRequest
 * @package App\Http\Requests\Core\Access\User
 */
class EditPersonRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('edit-people');
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
