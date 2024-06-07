<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class SesData extends Model
{
    use HasFactory;
    
    /**
     * 作成日時カラム
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    
    /**
     * 更新日時カラム
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';
    
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'sesDatas';
    
    /**
     * 型をキャストするカラム
     *
     * @var array
     */
    protected $casts = [
        'admission_date' => 'datetime',
        'exit_date' => 'datetime'
    ];
    
    /*
     * 保存するカラム
     *
     * @array
     */
    protected $fillable = [
        'company_name',
        'case_name',
        'personnel_name',
        'deposit_amount',
        'payment_site',
        'deposit_irregular',
        'deposit_bank',
        'withdrawal_amount',
        'withdrawal_date',
        'withdrawal_irregular',
        'withdrawal_bank',
        'admission_date',
        'exit_date'
    ];

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
     * 最終支払日を取得
     */
    public function getLastPaymentDay()
    {
        //支払予定日
        $scheduleDay = $this->payment_site ? config('paymentSite')[$this->payment_site] - 30 : $this->withdrawal_date;
        $scheduleDay = new DateTime($this->exit_date->modify('+2 month')->format('Y-m').'-'.$scheduleDay);

        //支払いサイト30日の場合
        if ($this->payment_site == 1) {
            
            //支払予定日（月の最終日）
            $scheduleDay = new DateTime('last day of ' . $this->exit_date->modify('+1 month')->format('Y-m'));
        }
        
        //最終支払日（営業日）
        $lastPaymentDay = $this->getBusinessDay($scheduleDay, $this->getHolidays());
        
        return $lastPaymentDay;
    }
    
    /*
     * ステータス取得
     * 
     * @return int
     */
    public function getStatusAttribute()
    {
        //現在
        $now = new DateTime(now()->format('Y-m-d'));

        //入場日
        $admissionDate = new DateTime($this->admission_date);
        
        //ステータスを設定
        $status = 1;

        //入場日を過ぎた場合
        if ($now >= $admissionDate) {
            $status = 2;

            //退場日が設定されている場合
            if ($this->exit_date) {

                //退場日
                $exitDate = new DateTime($this->exit_date);
                
                if ($now <= $exitDate) {
                    
                    //退場日までの残り日数を算出
                    $limit = $exitDate->diff($now)->days;
    
                    //残り1か月以内の場合
                    if (($limit <= 31) && ($limit >= 0)) {
                        $status = 3;
                    }
                
                //退場日を過ぎた場合
                } else {
                    $status = 4;

                    //最終支払日を取得
                    $lastPaymentDay = $this->getLastPaymentDay();
                    
                    //最終支払日を過ぎた場合
                    if ($now > $lastPaymentDay) {
                        $status = 5;
                    }
                }
            }
        }

        return $status;
    }
    
    /*
     * 営業日取得
     * 
     * @param DateTime $date
     * @param array $holidays
     * @return bool
     */
    public function getBusinessDay(DateTime $date, array $holidays)
    {
        //営業日を設定
        $businessDay = $date;

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
            $date->modify('-1 days');
        }
        
        return $businessDay;
    }
}
