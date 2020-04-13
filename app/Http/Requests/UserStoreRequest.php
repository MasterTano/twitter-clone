<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        $nameRule = ['required', 'string', 'min:2', 'max:191'];

        return [
            'first_name' => $nameRule,
            'last_name' => $nameRule,
            'email' => ['required', 'email', 'max:191', 'unique:users,email'],
            'password' => ['required', 'alpha_dash', 'min:8', 'max:191']
        ];
    }
}
