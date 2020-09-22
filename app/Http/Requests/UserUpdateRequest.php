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
        $prefs = \Config::get('pref');
        return [
            'name'=> ['required','max:255'],
            'login_id'=> ['required','max:255', Rule::unique('users')->ignore($this->id)],
            'email'=> ['required','email','max:255', Rule::unique('users')->ignore($this->id)],
            'password'=> ['nullable','between:8,32','regex:/^[a-zA-Z-_]+$/'],
            'sex'=> [Rule::in(['男','女']), 'nullable'],
            'zip'=> ['regex:/^\d{3}[-]\d{4}$|^\d{7}$/','nullable'],
            'prefecture'=> [Rule::in($prefs), 'nullable'],
            'address'=> ['max:255'],
            'note'=> ['max:2000']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。入力して下さい',
            'password.between' => ':attributeは:min～:max文字で入力して下さい',
            'login_id.unique' => ':attributeが重複しています。変更して下さい',
            'email.unique' => ':attributeが重複しています。変更して下さい',
            'email.email' => '正しい:attribute形式で入力して下さい。',
            'max' => ':max文字以内で入力して下さい',
            'password.regex' => '半角英字、半角ハイフンまたは半角アンダースコアで入力して下さい',
            'sex.in' => '男・女から選択して下さい',
            'zip.regex' => '7桁、または半角ハイフンを含む3桁-4桁の形式で入力して下さい',
            'prefecture.in' => ':attributeから選択して下さい',
            ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'login_id' => 'ログインID',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'sex' => '性別',
            'zip' => '郵便番号',
            'prefecture' => '都道府県',
            'address' => '住所',
            'note' => '備考'];
    }
}
