<?php
declare(strict_types=1);

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use Illuminate\Support\Collection;

class FileOperateService
{
    /**
     * ダウンロード
     * 
     * @param Collection $shopDatas
     * @param Collection $sesDatas
     * @param Collection $otherDatas
     * @return void
     */
    public function download(Collection $shopDatas, Collection $sesDatas, Collection $otherDatas)
    {
        $spreadsheet = new Spreadsheet();
        
        //全体のフォント設定
        $spreadsheet->getDefaultStyle()->getFont()->setName('MS Pゴシック');
        
        //処理したいシートを取得
        $sheet = $spreadsheet->getActiveSheet();
        
        //書き込みデータを準備
        $writeDatas = [['', '○○店', '○○店', '会社名', '要員名', '入金種別', '金額', '入出金銀行', '摘要', '金額', '入金種別', '入出金銀行', '実残高']];

        for ($i = 1; $i <= 31; $i++) {
            $maxCount = 1;
            $sesDataCount = $sesDatas->has($i) ? $sesDatas[$i]->count() : 0;
            $otherDataCount = $otherDatas->has($i) ? $otherDatas[$i]->count() : 0;
            if ($sesDataCount || $otherDataCount) {
                $maxCount = ($sesDataCount >= $otherDataCount) ? $sesDataCount : $otherDataCount;
            }
            
            for ($j = 0; $j < $maxCount; $j++) {
                
                //日付
                $addWriteDatas = [$i];
                
                //飲食店データ
                $shopWriteDatas = ['', ''];
                if ($shopDatas->has($i) && ($j === 0)) {
                    
                    $shopWriteDatas = [
                        number_format($shopDatas[$i]->sales1),
                        number_format($shopDatas[$i]->sales2)
                    ];
                }
                $addWriteDatas = array_merge($addWriteDatas, $shopWriteDatas);
                
                //SESデータ
                $sesWriteDatas = ['', '', '', '', ''];
                if ($sesDatas->has($i) && ($sesDataCount > $j)) {
                    
                    $sesWriteDatas = [
                        $sesDatas[$i][$j]->company_name,
                        $sesDatas[$i][$j]->personnel_name,
                        config('forms.type')[$sesDatas[$i][$j]->type],
                        number_format($sesDatas[$i][$j]->amount),
                        $sesDatas[$i][$j]->bank
                    ];
                }
                $addWriteDatas = array_merge($addWriteDatas, $sesWriteDatas);
                
                //その他データ
                $otherWriteDatas = ['', '', '', ''];
                if ($otherDatas->has($i) && ($otherDataCount > $j)) {
                    
                    $otherWriteDatas = [
                        $otherDatas[$i][$j]->summaryItem[0]->name,
                        number_format($otherDatas[$i][$j]->amount),
                        config('forms.type')[$otherDatas[$i][$j]->type],
                        $otherDatas[$i][$j]->bank
                    ];
                }
                $addWriteDatas = array_merge($addWriteDatas, $otherWriteDatas);
            }

            //実残高
            $writeDatas[] = array_merge($addWriteDatas, [number_format(5000000)]);
        }

        $sheet->fromArray($writeDatas, null, 'A2');
        
        for ($i = 'A'; $i != 'M'; $i++) {
            
            //セル幅自動調整
            $sheet->getColumnDimension($i)->setAutoSize(true);
            
            //太字
            $sheet->getStyle($i.'1')->getFont()->setBold(true)->setSize(10);
        }

        //ファイル名を設定
        $fileName = 'CM表.xlsx';

        //Excelファイルをダウンロード
        $writer = new XlsxWriter($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$fileName}\"");
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}