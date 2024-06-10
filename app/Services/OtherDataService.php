<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\OtherData;

class OtherDataService
{
    /**
     * 一覧取得
     * 
     * @return Collection
     */
    public function getList()
    {
        $otherDatas = OtherData::get();
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