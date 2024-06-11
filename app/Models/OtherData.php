<?php

namespace App\Models;

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
    protected $fillable = ['summary_id', 'amount', 'type', 'date', 'irregular', 'bank'];
    
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
