<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
            'name' => 'required|unique:users|string|max:255',
            'email' => 'required|unique:users|string|max:255',
            'password' => 'required|string|max:255|regex:/^[0-9a-zA-z]+$/',
            'image' => 'file|image|mimes:jpeg,png,jpg',
            'self_introduction' => 'max:255',
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
            'name.required' => '必須入力です。',
            'name.unique' => '既に登録されています。',
            'name.max' => '255文字以内で入力してください。',
            'email.required' => '必須入力です。',
            'email.unique' => '既に登録されています。',
            'email.max' => '255文字以内で入力してください。',
            'password.required' => '必須入力です。',
            'password.max' => '255文字以内で入力してください。',
            'password.regex' => '正しい形式を入力してください。'
        ];
    }
}
