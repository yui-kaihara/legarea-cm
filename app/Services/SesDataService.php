<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\SesData;

class SesDataService
{
    /**
     * 一覧取得
     * 
     * @param bool $groupByFlag
     * @return Collection
     */
    public function getList(bool $groupByFlag = FALSE)
    {
        $sesDatas = SesData::get();
        
        if ($groupByFlag) {

            //アクセサで支払日を取得
            foreach ($sesDatas as $index => $sesData) {
                $sesData->payment_day = $sesData->payment_day;

                if (!in_array($sesData->status, [3, 5, 7])) {
                    $sesDatas->forget($index);
                }
            }
  
            //支払日でグループ化し、キーに設定
            $sesDatas = $sesDatas->groupBy('payment_day')->mapWithKeys(function ($items, $key) {
                return [$key => $items];
            });
        }

        return $sesDatas;
    }
    
    /**
     * 詳細取得
     * 
     * @param int $id
     * @return SesData
     */
    public function getDetail(int $id)
    {
        $sesData = SesData::find($id);
        return $sesData;
    }
    
    /*
     * 出金詳細を取得
     *
     * @param int $id
     * @return SesData
     */
    public function getWithdrawalDetail(int $id)
    {
        $withdrawalData = SesData::where('deposit_id', '=', $id)->first();
        return $withdrawalData;
    }

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $sesData = new SesData();
        return $sesData->create($requests);
    }
    
    /**
     * 更新処理
     * 
     * @param array $requests
     * @param int $id
     * @param int $depositId
     * @return void
     */
    public function update(array $requests, int $id = null, int $depositId = null)
    {
        $sesData = SesData::find($id);
        
        if ($depositId) {
            $sesData = SesData::where('deposit_id', '=', $depositId)->first();
        }

        $sesData->fill($requests)->save();
    }
    
    /**
     * 削除処理
     * 
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $sesData = SesData::find($id);
        $sesData->delete();
    }
}