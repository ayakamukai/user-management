<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkRequest extends FormRequest
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
            'site_name'=> ['required','max:255'],
            'url'=> ['required','max:255','url'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。入力して下さい',
            'max' => ':max文字以内で入力して下さい',
            'url.url' => '正しいURL形式で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'site_name' => 'サイト名',
            'url' => 'サイトURL',
            ];
    }

}
