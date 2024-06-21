<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\BalanceData;
use App\Services\IrregularOtherDataService;
use App\Services\IrregularSesDataService;
use App\Services\OtherDataService;
use App\Services\SesDataService;
use App\Services\ShopDataService;
use Illuminate\Support\Carbon;

class BalanceDataService
{
    /**
     * コンストラクタ
     * 
     * @param IrregularOtherDataService $irregularOtherDataService
     * @param IrregularSesDataService $irregularSesDataService
     * @param OtherDataService $otherDataService
     * @param SesDataService $sesDataService
     * @param ShopDataService $shopDataService
     */
    public function __construct(
        IrregularOtherDataService $irregularOtherDataService,
        IrregularSesDataService $irregularSesDataService,
        OtherDataService $otherDataService,
        SesDataService $sesDataService,
        ShopDataService $shopDataService,
    )
    {
        $this->irregularOtherDataService = $irregularOtherDataService;
        $this->irregularSesDataService = $irregularSesDataService;
        $this->otherDataService = $otherDataService;
        $this->sesDataService = $sesDataService;
        $this->shopDataService = $shopDataService;
    }

    /**
     * 詳細取得
     * 
     * @param string $yearMonth
     * @return BalanceData
     */
    public function getDetail(string $yearMonth)
    {
        $balanceData = BalanceData::where('month', '=', $yearMonth)->first();
        return $balanceData;
    }
    
    /**
     * 更新処理
     * 
     * @param array $requests
     * @param int $id
     * @return void
     */
    public function update()
    {
        $year = now()->format('Y');
        for ($i = $year - 1; $i <= $year; $i++) {
            for ($j = 1; $j <= 12; $j++) {
                $yearMonth = $i.'-'.sprintf('%02d', $j);

                //飲食データを取得
                $shopDatas = $this->shopDataService->getList($yearMonth);
        
                //SESデータを取得
                $sesDatas = $this->sesDataService->getList(TRUE);
                $irregularSesDatas = $this->irregularSesDataService->getList($yearMonth);
                $sesDatas = $sesDatas->union($irregularSesDatas);
                
                //その他データを取得
                $otherDatas = $this->otherDataService->getList(TRUE, $yearMonth);
                $irregularOtherDatas = $this->irregularOtherDataService->getList($yearMonth);
                $otherDatas = $otherDatas->union($irregularOtherDatas);
                
                $shopAmount = 0;
                foreach ($shopDatas as $shopData) {
                    $shopAmount = $shopAmount + $shopData->sales1 + $shopData->sales2;
                }
                
                $sesAmount = 0;
                foreach ($sesDatas as $sesData) {
                    foreach ($sesData as $data) {
                        $data = $data->irregularSesData ?? $data;
                        $addAmount = (($data->type == 1) ? '+' : '-').$data->amount;
                        $sesAmount = $sesAmount + $addAmount;
                    }
                }
                
                $otherAmount = 0;
                foreach ($otherDatas as $otherData) {
                    foreach ($otherData as $data) {
                        $data = $data->irregularSesData ?? $data;
                        $addAmount = (($data->type == 1) ? '+' : '-').$data->amount;
                        $otherAmount = $otherAmount + $addAmount;
                    }
                }
                
                $lastMonth = ($j - 1) ?? '12';
                $lastMonthYear = ($lastMonth == '12') ? $year - 1 : $year;
                
                $lastMonthTotal = $this->getDetail($lastMonthYear.'-'.sprintf('%02d', $lastMonth))->amount ?? 0;
                $total = $lastMonthTotal + $shopAmount + $sesAmount + $otherAmount;

                BalanceData::updateOrCreate(['month' => $yearMonth], ['month' => $yearMonth, 'amount' => $total]);
            }
        }
    }
}