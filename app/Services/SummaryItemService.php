<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\SummaryItem;

class SummaryItemService
{
    /**
     * 一覧取得
     * 
     * @return Collection
     */
    public function getList()
    {
        $summaryItems = SummaryItem::get();
        return $summaryItems;
    }
    
    /**
     * 詳細取得
     * 
     * @param int $id
     * @return SummaryItem
     */
    public function getDetail(int $id)
    {
        $summaryItem = SummaryItem::find($id);
        return $summaryItem;
    }

    /**
     * 保存処理
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $summaryItem = new SummaryItem();
        $summaryItem->fill($requests)->save();
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
        $summaryItem = SummaryItem::find($id);
        $summaryItem->fill($requests)->save();
    }
    
    /**
     * 削除処理
     * 
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $summaryItem = SummaryItem::find($id);
        $summaryItem->delete();
    }
}