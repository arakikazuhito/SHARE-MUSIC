<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'email' => 'required|email:filter|exists:users,email|max:254'

        ];
    }
    /**
     * バリデーションメッセージのカスタマイズ
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => '必須入力です。',
            'email.email' => '正しい形式で入力してください。',
            'email.exists' => '登録されていません。',
            'email.max' => '254文字以内で入力してください。'
        ];
    }
}
