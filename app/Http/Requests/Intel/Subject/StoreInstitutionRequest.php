<?php namespace App\Http\Requests\Core\People;

use App\Http\Requests\Request;

/**
 * Class StoreUserRequest
 * @package App\Http\Requests\Core\Access\User
 */
class StoreInstitutionRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('create-institutions');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}
