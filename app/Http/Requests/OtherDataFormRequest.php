<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtherDataFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'summary_id' => ['required'],
            'amount' => ['required'],
            'type' => ['required', 'in:1,2'],
            'date' => ['required'],
            'irregular' => ['required', 'in:1,2'],
            'bank' => ['required']
        ];
    }
    
    /**
     * エラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => '入力必須です',
            'in' => '選択してください'
        ];
    }
}
