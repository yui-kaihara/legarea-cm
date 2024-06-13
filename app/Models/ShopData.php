<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopData extends Model
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
    protected $table = 'shopDatas';
    
    /*
     * 保存するカラム
     *
     * @array
     */
    protected $fillable = ['date', 'sales1', 'sales2'];
    
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
     * SESデータを取得
     *
     * @return App\Models\SesData
     */
    public function sesData()
    {
        return $this->belongsTo(SesData::class);
    }
}
