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
            'deposit_amount' => ['required_without_all:deposit_amount, withdrawal_amount'],
            'payment_site' => ['required_with:deposit_amount'],
            'deposit_irregular' => ['required_with:deposit_amount'],
            'deposit_bank' => ['required_with:deposit_amount'],
            'withdrawal_date' => ['required_with:withdrawal_amount'],
            'withdrawal_irregular' => ['required_with:withdrawal_amount'],
            'withdrawal_bank' => ['required_with:withdrawal_amount'],
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
            'required_without_all' => '入金・出金どちらかは入力必須です',
            'required_with' => '入力必須です'
        ];
    }
}
