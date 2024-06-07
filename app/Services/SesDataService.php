<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\SesData;

class SesDataService
{
    /**
     * 一覧取得
     * 
     * @return Collection
     */
    public function getList()
    {
        $sesDatas = SesData::get();
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

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $sesData = new SesData();
        $sesData->fill($requests)->save();
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
        $sesData = SesData::find($id);
        $sesData->fill($requests)->save();
    }
}