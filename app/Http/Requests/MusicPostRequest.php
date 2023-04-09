<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MusicPostRequest extends FormRequest
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
            'music_name' => 'required|string|max:255',
            'music_path' => 'required|file|mimes:mp3,wave,ogg',
            'category' => 'required|string|max:255',
            'image' => 'file|image|mimes:jpeg,png,jpg',
            'description' => 'max:255',
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
            'music_name.required' => '必ず入力してください。',
            'music_name.max' => '255文字以内で入力してください。',
            'music_path.required' => '曲を選択してください。',
            'music_path.mimes' => '拡張子を確認してください　mp3,wave,ogg',
            'category.required' => '必ず入力してください。',
            'description.max' => '255文字以内で入力してください',
        ];
    }
}
