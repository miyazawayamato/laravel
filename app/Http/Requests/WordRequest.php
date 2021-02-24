<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
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
            //
            'title' => 'required|max:20',
            'body' => 'required|max:250'
        ];
    }
    // エラーメッセージ
    public function messages()
    {
        return [
            'title.required' => '内容を入力してください',
            'title.max' => '文字数がオーバーしています',
            'body.required' => '内容を入力してください',
            'body.max' => '文字数がオーバーしています',
        ];
    }
}
