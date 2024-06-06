<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesData extends Model
{
    use HasFactory;
    
    /**
     * 作成日時カラム
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    
    /**
     * 更新日時カラム
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';
    
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'sesDatas';
    
    /*
     * 保存するカラム
     *
     * @array
     */
    protected $fillable = [
        'company_name',
        'case_name',
        'personnel_name',
        'deposit_amount',
        'payment_site',
        'deposit_irregular',
        'deposit_bank',
        'withdrawal_amount',
        'withdrawal_date',
        'withdrawal_irregular',
        'withdrawal_bank',
        'admission_date',
        'exit_date'
    ];
}
