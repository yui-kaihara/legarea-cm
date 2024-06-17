<?php

namespace App\Models;

use App\Services\CalcPaymentDayService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrregularOtherData extends Model
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
    protected $table = 'irregularOtherDatas';
    
    /*
     * 保存するカラム
     *
     * @array
     */
    protected $fillable = ['date', 'summary_id', 'amount', 'type', 'bank'];
    
    /*
     * その他データを取得
     *
     * @return App\Models\OtherData
     */
    public function otherData()
    {
        return $this->belongsTo(OtherData::class);
    }
    
    /*
     * 摘要項目を取得
     *
     * @return App\Models\SummaryItem
     */
    public function summaryItem()
    {
        return $this->hasMany(SummaryItem::class, 'id', 'summary_id');
    }
}
