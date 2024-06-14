<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ShopData;
use Illuminate\Support\Carbon;

class ShopDataService
{
    /**
     * 一覧取得
     * 
     * @param string $yearmonth
     * @return Collection
     */
    public function getList(string $yearMonth)
    {
        //取得するカラムを設定
        $query = ShopData::select('sales1', 'sales2');
        $query->selectRaw('DAY(date) as day');
        $query->whereYear('date', Carbon::parse($yearMonth)->year);
        $query->whereMonth('date', Carbon::parse($yearMonth)->month);
        
        //日にちでグループ化し、キーに設定して取得
        $shopDatas = $query->groupByRaw('DAY(date)')->get()->keyBy('day');
        
        return $shopDatas;
    }
    
    /**
     * 詳細取得
     * 
     * @param int $id
     * @return OtherData
     */
    public function getDetail(int $id)
    {
        $shopData = ShopData::find($id);
        return $shopData;
    }

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $shopData = new ShopData();
        $shopData->fill($requests)->save();
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
        $shopData = ShopData::find($id);
        $shopData->fill($requests)->save();
    }
    
    /**
     * 削除処理
     * 
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $shopData = ShopData::find($id);
        $shopData->delete();
    }
}