<?php namespace App\Http\Requests\Core\People;

use App\Http\Requests\Request;

/**
 * Class DeleteUserRequest
 * @package App\Http\Requests\Core\Access\User
 */
class DeleteInstitutionRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('delete-institutions');
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