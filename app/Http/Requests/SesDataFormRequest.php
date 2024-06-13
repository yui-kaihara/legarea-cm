<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SesDataFormRequest extends FormRequest
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
            'company_name' => ['required'],
            'case_name' => ['required'],
            'personnel_name' => ['required'],
            'deposit_amount' => ['required'],
            'deposit_payment_site' => ['required', 'in:1,2,3,4,5,6'],
            'deposit_irregular' => ['required', 'in:1,2'],
            'deposit_bank' => ['required'],
            'deposit_payment_site' => ['nullable', 'required_with:withdrawal_amount', 'in:1,2,3,4,5,6'],
            'withdrawal_irregular' => ['nullable', 'required_with:withdrawal_amount', 'in:1,2'],
            'withdrawal_bank' => ['nullable', 'required_with:withdrawal_amount'],
            'admission_date' => ['required']
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
            'required_with' => '入力必須です',
            'in' => 'リストから選択してください'
        ];
    }
}
