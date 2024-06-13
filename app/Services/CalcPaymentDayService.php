<?php
declare(strict_types=1);

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class CalcPaymentDayService
{
    /*
     * 祝日を取得
     *
     * @return array
     */
    public function getHolidays()
    {
        $year = now()->format('Y');

        //CSVファイル名
        $csvFileName = 'holidays-'.$year.'.csv';

        if (!Storage::exists($csvFileName)) {

            //去年のファイルを削除
            Storage::delete('holidays-'.($year - 1).'.csv');

            //今年のCSVファイルを取得
            $response = Http::get('https://holidays-jp.github.io/api/v1/{$year}/date.csv');

            //CSVデータを取得
            $csvData = $response->body();

            //取得したCSVデータを保存
            Storage::put($csvFileName, $csvData);
        }

        //ファイルのパスを取得
        $filePath = Storage::path($csvFileName);

        //CSVファイルを読み込む
        $csv = Reader::createFromPath($filePath, 'r');

        //レコードを取得
        $records = $csv->getRecords();

        //データを配列に変換
        $data = iterator_to_array($records);

        //日付だけを取得
        $holidays = array_column($data, 0);

        return $holidays;
    }
    
    /*
     * 営業日取得
     * 
     * @param DateTime $date
     * @return int
     */
    public function getBusinessDay(DateTime $date, int $irregularStatus = 1)
    {
        //営業日を設定
        $businessDay = $date;
        
        //祝日を取得
        $holidays = $this->getHolidays();
        
        //土日祝の場合（前or後）
        $sign = ($irregularStatus == 1) ? '-' : '+';

        while (true) {
            
            //曜日を取得
            $week = (int)$date->format('w');

            //土日以外
            if (($week > 0) && ($week < 6)) {

                //祝日リストにない
                if (!in_array($date->format('Y-m-d'), $holidays, true)) {
                    $businessDay = $date;
                    break;
                }
            }
            
            //休日の場合は前日をチェック
            $date->modify($sign.'1 days');
        }
        
        return $businessDay;
    }
}