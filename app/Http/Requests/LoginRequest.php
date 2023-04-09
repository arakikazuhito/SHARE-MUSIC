<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255|regex:/^[0-9a-zA-z]+$/',
        ];
    }
    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => '必須入力です。',
            'email.max' => '255文字以内で入力してください。',
            'password.required' => '必須入力です。',
            'password.max' => '255文字以内で入力してください。',
            'password.regex' => '正しい形式を入力してください。'
        ];
    }
}
