<?php

namespace App\Http\Requests;

use App\Models\SummaryItem;
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
        $summaryItemIds = SummaryItem::pluck('id')->all();

        return [
            'date' => ['required'],
            'company_name' => ['nullable', 'required_with:personnel_name,ses_type,ses_amount,ses_bank'],
            'personnel_name' => ['nullable', 'required_with:company_name,ses_type,ses_amount,ses_bank'],
            'ses_type' => ['nullable', 'required_with:company_name,personnel_name,ses_amount,ses_bank', 'in:1,2'],
            'ses_amount' => ['nullable', 'required_with:company_name,personnel_name,ses_type,ses_bank'],
            'ses_bank' => ['nullable', 'required_with:company_name,personnel_name,ses_type,ses_amount'],
            'summary_id' => ['nullable', 'required_with:other_amount,other_type,other_bank', 'in:'.implode(',', $summaryItemIds)],
            'other_amount' => ['nullable', 'required_with:summary_id,other_type,other_bank'],
            'other_type' => ['nullable', 'required_with:summary_id,other_amount,other_bank', 'in:1,2'],
            'other_bank' => ['nullable', 'required_with:summary_id,other_amount,other_type']
            
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
            'required' => '※必須です',
            'required_with' => '※入力してください',
            'in' => '※リストから選択してください'
        ];
    }
}
