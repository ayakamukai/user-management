<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=> ['required','max:255'],
            'login_id'=> ['required','max:255','unique:users'],
            'email'=> ['email','max:255'],
            'password'=> ['required','between:8,32','regex:/^[a-zA-Z-_]+$/']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。入力して下さい',
            'between' => 'パスワードは8～32文字で入力して下さい',
            'login_id.unique' => 'ログインIDが重複しています。変更して下さい',
            'email' => '正しいメールアドレス形式で入力して下さい。',
            'max' => ':max文字以内で入力して下さい',
            'password.regex' => '半角英字、半角ハイフンまたは半角アンダースコアで入力して下さい'
            ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'login_id' => 'ログインID',
            'email' => 'メールアドレス',
            'password' => 'パスワード'];
    }
}
