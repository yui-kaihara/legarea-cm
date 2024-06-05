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
            'companyName' => ['required'],
            'caseName' => ['required'],
            'personnelName' => ['required'],
            'depositAmount' => ['required'],
            'paymentSite' => ['required'],
            'depositIrregular' => ['required'],
            'depositBank' => ['required'],
            'withdrawalAmount' => ['required'],
            'withdrawalDate' => ['required'],
            'withdrawalIrregular' => ['required'],
            'withdrawalBank' => ['required'],
            'admissionDate' => ['required']
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
            'required' => '必須項目です'
        ];
    }
}
