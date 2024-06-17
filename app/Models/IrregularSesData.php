<?php

namespace App\Models;

use App\Services\CalcPaymentDayService;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class IrregularSesData extends Model
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
    protected $table = 'irregularSesDatas';
    
    /**
     * 型をキャストするカラム
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime'
    ];
    
    /*
     * 保存するカラム
     *
     * @array
     */
    protected $fillable = [
        'date',
        'company_name',
        'personnel_name',
        'type',
        'amount',
        'bank'
    ];
    
    /*
     * SESデータを取得
     *
     * @return App\Models\SesData
     */
    public function sesData()
    {
        return $this->belongsTo(SesData::class);
    }
}
