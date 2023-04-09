<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TokenExpirationTimeRule;

class ResetPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required|regex:/^[0-9a-zA-z]+$/|min:8|max:32',
            'reset_token' => ['required', new TokenExpirationTimeRule],
        ];
    }
    public function messages()
    {
        return [
            'password.required' => '必須入力です。',
            'password.regex' => '正しい形式で入力してください。',
            'password.min'   => '8文字以上32文字以内で入力ください。',
            'password.max'   => '8文字以上32文字以内で入力ください。',
        ];
    }
}
