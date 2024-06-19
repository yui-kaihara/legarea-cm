<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\IrregularSesData;
use Illuminate\Support\Carbon;

class IrregularSesDataService
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
        $query = IrregularSesData::select('id', 'company_name', 'personnel_name', 'type', 'amount', 'bank');
        $query->selectRaw('DAY(date) as day');
        $query->whereYear('date', Carbon::parse($yearMonth)->year);
        $query->whereMonth('date', Carbon::parse($yearMonth)->month);
        
        //日にちでグループ化し、キーに設定して取得
        $irregularSesDatas = $query->get()->groupBy('day')->mapWithKeys(function ($items, $key) {
            return [$key => $items];
        });
        
        foreach ($irregularSesDatas as $irregularSesData) {
            foreach ($irregularSesData as $data) {
                $data->irregularFlag = TRUE;
            }
        }

        return $irregularSesDatas;
    }
    
    /**
     * 詳細取得
     * 
     * @param int $id
     * @return IrregularSesData
     */
    public function getDetail(int $id)
    {
        $irregularSesData = IrregularSesData::find($id);
        return $irregularSesData;
    }

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $irregularSesData = new IrregularSesData();
        $irregularSesData->fill($requests)->save();
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
        $irregularSesData = IrregularSesData::find($id);
        $irregularSesData->fill($requests)->save();
    }
    
    /**
     * 削除処理
     * 
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $irregularSesData = IrregularSesData::find($id);
        $irregularSesData->delete();
    }
}