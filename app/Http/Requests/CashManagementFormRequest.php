<?php

namespace App\Http\Requests;

use App\Models\SummaryItem;
use App\Rules\AllOrNone;
use Illuminate\Foundation\Http\FormRequest;

class CashManagementFormRequest extends FormRequest
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
            'date' => ['required'],
            'company_name' => ['nullable', new AllOrNone(['company_name', 'personnel_name', 'ses_type', 'ses_amount', 'ses_bank'])]
            
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
            'required' => '必須です'
        ];
    }
}
