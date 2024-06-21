<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\IrregularOtherData;
use Illuminate\Support\Carbon;

class IrregularOtherDataService
{
    /**
     * 一覧取得
     * 
     * @param string $yearMonth
     * string $yearMonth
     * @return Collection
     */
    public function getList(string $yearMonth)
    {
        $query = IrregularOtherData::select('id', 'summary_id', 'amount', 'type', 'bank');
        $query->selectRaw('DAY(date) as day');
        $query->whereYear('date', Carbon::parse($yearMonth)->year);
        $query->whereMonth('date', Carbon::parse($yearMonth)->month);
        $query->whereNull('other_data_id');
        $query->whereNotNull('summary_id');
        
        //日にちでグループ化し、キーに設定して取得
        $irregularOtherDatas = $query->get()->groupBy('day')->mapWithKeys(function ($items, $key) {
            return [$key => $items];
        });
        
        foreach ($irregularOtherDatas as $irregularOtherData) {
            foreach ($irregularOtherData as $data) {
                $data->irregularFlag = TRUE;
            }
        }

        return $irregularOtherDatas;
    }
    
    /**
     * 詳細取得
     * 
     * @param int $id
     * @return IrregularOtherData
     */
    public function getDetail(int $id)
    {
        $irregularOtherData = IrregularOtherData::find($id);
        return $irregularOtherData;
    }

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $irregularOtherData = new IrregularOtherData();
        $irregularOtherData->fill($requests)->save();
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
        $irregularOtherData = IrregularOtherData::find($id);
        $irregularOtherData->fill($requests)->save();
    }
}