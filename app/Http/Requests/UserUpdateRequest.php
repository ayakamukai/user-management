<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'login_id'=> ['required','max:255', Rule::unique('users')->ignore($this->id)],
            'email'=> ['max:255','email'],
            'password'=> ['nullable','between:8,32','regex:/^[a-zA-Z-_]+$/']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeが入力されていません',
            'between' => 'パスワードは8～32文字で入力してください',
            'login_id.unique' => 'ログインIDが重複しています',
            'email' => '正しい形式で入力してください',
            'password.regex' => '半角英字、半角ハイフンまたは半角アンダースコアで入力してください'
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
