<?php

namespace App\Models;

use App\Services\CalcPaymentDayService;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherData extends Model
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
    protected $table = 'otherDatas';
    
    /*
     * 保存するカラム
     *
     * @array
     */
    protected $fillable = ['summary_id', 'amount', 'type', 'date', 'irregular', 'startMonth', 'bank'];
    
    /*
     * 支払日取得
     * 
     * @return int
     */
    public function getPaymentDayAttribute()
    {
        //支払予定日
        $scheduleDay = new DateTime(now()->format('Y-m').'-'.$this->date);

        //最終支払日を取得
        $calcPaymentDayService = new CalcPaymentDayService();
        $lastPaymentDay = $calcPaymentDayService->getBusinessDay($scheduleDay, $this->irregular)->format('j');
        
        return $lastPaymentDay;
    }
    
    /*
     * 飲食データを取得
     *
     * @return App\Models\ShopData
     */
    public function shopData()
    {
        return $this->hasOne(ShopData::class);
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
