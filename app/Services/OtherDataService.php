<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\OtherData;

class OtherDataService
{
    /**
     * 一覧取得
     * 
     * @param bool $groupByFlag
     * string $yearMonth
     * @return Collection
     */
    public function getList(bool $groupByFlag = FALSE, string $yearMonth = null)
    {
        $otherDatas = OtherData::get();

        if ($groupByFlag) {
            
            //表示する年月が開始月以降のデータのみ取得
            if ($yearMonth) {
                $otherDatas = OtherData::where('start_month', '<=', $yearMonth);
            }
            
            //終了月が存在しないor終了月が存在し、表示する年月が終了月以前のデータのみ取得
            $otherDatas->where(function ($query) use ($yearMonth) {
                $query->where(function ($whereQuery) use ($yearMonth) {
                    $whereQuery->whereNotNull('end_month');
                    $whereQuery->where('end_month', '>=', $yearMonth);
                })->orWhereNull('end_month');
            });
            
            $otherDatas = $otherDatas->get();

            //アクセサで支払日を取得
            foreach ($otherDatas as $otherData) {
                $otherData->payment_day = $otherData->payment_day;
                $otherData->irregularFlag = FALSE;
            }
            
            //支払日でグループ化し、キーに設定
            $otherDatas = $otherDatas->groupBy('payment_day')->mapWithKeys(function ($items, $key) {
                return [$key => $items];
            });
        }

        return $otherDatas;
    }
    
    /**
     * 詳細取得
     * 
     * @param int $id
     * @return OtherData
     */
    public function getDetail(int $id)
    {
        $otherData = OtherData::find($id);
        return $otherData;
    }

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $otherData = new OtherData();
        $otherData->fill($requests)->save();
    }
    
    /**
     * 更新処理
     * 
     * @param array $requests
     * @param int $id
     * @return void
     */
    public function update(array $requests, int $id)
    {
        $otherData = OtherData::find($id);
        $otherData->fill($requests)->save();
    }
    
    /**
     * 削除処理
     * 
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $otherData = OtherData::find($id);
        $otherData->delete();
    }
}