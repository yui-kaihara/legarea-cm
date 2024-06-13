<?php

namespace App\Models;

use App\Services\CalcPaymentDayService;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

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
        'admission_date',
        'exit_date',
        'deposit_amount',
        'deposit_payment_site',
        'deposit_irregular',
        'deposit_bank',
        'withdrawal_amount',
        'withdrawal_payment_site',
        'withdrawal_irregular',
        'withdrawal_bank',
        'deposit_id'
    ];

    /*
     * 支払日取得
     * 
     * @return int
     */
    public function getPaymentDayAttribute()
    {
        //支払予定日
        $scheduleDay = config('forms.paymentSite')[$this->deposit_payment_site] - 30;
        $scheduleDay = new DateTime(now()->format('Y-m').'-'.$scheduleDay);
        
        //支払いサイト30日の場合
        if ($this->deposit_payment_site == 1) {
            
            //支払予定日（月の最終日）
            $scheduleDay = new DateTime('last day of ' . now()->format('Y-m'));
        }

        //最終支払日を取得
        $calcPaymentDayService = new CalcPaymentDayService();
        $lastPaymentDay = $calcPaymentDayService->getBusinessDay($scheduleDay)->format('j');
        
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
            
            //支払予定日
            $scheduleDay = config('forms.paymentSite')[$this->deposit_payment_site] - 30;
            $scheduleDay = new DateTime($this->admission_date->modify('+2 month')->format('Y-m').'-'.$scheduleDay);
    
            //支払いサイト30日の場合
            if ($this->deposit_payment_site == 1) {
                
                //支払予定日（月の最終日）
                $scheduleDay = new DateTime('last day of ' . $this->admission_date->modify('+1 month')->format('Y-m'));
            }

            //初回支払日を取得
            $calcPaymentDayService = new CalcPaymentDayService();
            $firstPaymentDay = $calcPaymentDayService->getBusinessDay($scheduleDay);

            //初回支払月以降かどうか
            $status = ($now->format('Y-m') >= $firstPaymentDay->format('Y-m')) ? 3 : 2;
            
            //退場日が設定されている場合
            if ($this->exit_date) {

                //退場日
                $exitDate = new DateTime($this->exit_date);

                if ($now <= $exitDate) {

                    //退場日までの残り日数を算出
                    $limit = $exitDate->diff($now)->days;
    
                    //残り1か月以内の場合
                    if (($limit <= 31) && ($limit >= 0)) {
                        $status = ($now->format('Y-m') >= $firstPaymentDay->format('Y-m')) ? 5 : 4;
                    }
                
                //退場日を過ぎた場合
                } else {
                    $status = ($now->format('Y-m') >= $firstPaymentDay->format('Y-m')) ? 7 : 6;
                    
                    //支払予定日
                    $scheduleDay = config('forms.paymentSite')[$this->deposit_payment_site] - 30;
                    $scheduleDay = new DateTime($this->exit_date->modify('+2 month')->format('Y-m').'-'.$scheduleDay);
            
                    //支払いサイト30日の場合
                    if ($this->deposit_payment_site == 1) {
                        
                        //支払予定日（月の最終日）
                        $scheduleDay = new DateTime('last day of ' . $this->exit_date->modify('+1 month')->format('Y-m'));
                    }

                    //最終支払日を取得
                    $calcPaymentDayService = new CalcPaymentDayService();
                    $lastPaymentDay = $calcPaymentDayService->getBusinessDay($scheduleDay);
                    
                    //最終支払日を過ぎた場合
                    if ($now > $lastPaymentDay) {
                        $status = 8;
                    }
                }
            }
        }

        return $status;
    }
    
    /*
     * 飲食データを取得
     *
     * @return App\Models\ShopData
     */
    public function shopData()
    {
        return $this->hasOne(ShopData::class);
    }
}
