<?php namespace App\Http\Requests\Front\Access;

use App\Http\Requests\Request;

/**
 * Class ChangePasswordRequest
 * @package App\Http\Requests\Front\Access
 */
class ChangePasswordRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'  =>  'required',
            'password'      =>  'required|alpha_num|min:6|confirmed',
        ];
    }
}