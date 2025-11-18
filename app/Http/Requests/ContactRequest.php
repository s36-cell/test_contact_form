<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * 誰でもこのリクエストを使えるようにする
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'in:男性,女性,その他'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 数字とハイフンのみ、10〜15桁程度を許可
            'tel' => ['required', 'regex:/^[0-9\-]{10,15}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'detail' => ['required', 'string'],
        ];
    }

    /**
     * 各項目の表示名（エラーメッセージに使われる）
     */
    public function attributes(): array
    {
        return [
            'last_name'   => 'お名前（姓）',
            'first_name'  => 'お名前（名）',
            'gender'      => '性別',
            'email'       => 'メールアドレス',
            'tel'         => '電話番号',
            'address'     => '住所',
            'building'    => '建物名',
            'category_id' => 'お問い合わせの種類',
            'detail'      => 'お問い合わせ内容',
        ];
    }

    /**
     * 個別のエラーメッセージ
     */
    public function messages(): array
    {
        return [
            'last_name.required'  => 'お名前（姓）を入力してください。',
            'first_name.required' => 'お名前（名）を入力してください。',

            'gender.required' => '性別を選択してください。',
            'gender.in'       => '性別は「男性」「女性」「その他」から選択してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.email'    => 'メールアドレスの形式で入力してください。',
            'email.max'      => 'メールアドレスは255文字以内で入力してください。',

            'tel.required' => '電話番号を入力してください。',
            'tel.regex'    => '電話番号は数字とハイフンのみで10〜15桁程度で入力してください。',

            'address.required' => '住所を入力してください。',
            'address.max'      => '住所は255文字以内で入力してください。',

            'building.max' => '建物名は255文字以内で入力してください。',

            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'category_id.exists'   => '選択されたお問い合わせの種類が不正です。',

            'detail.required' => 'お問い合わせ内容を入力してください。',
        ];
    }
}