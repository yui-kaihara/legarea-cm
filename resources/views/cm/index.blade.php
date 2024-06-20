<x-app-layout>
    <x-slot name="header">CM表</x-slot>

@if (session('flash_message'))
    <p class="px-4 py-3 bg-blue-100 text-blue-800 text-center font-semibold text-sm md:text-base">
        {{ session('flash_message') }}
    </p>
@endif

    <div class="w-11/12 lg:w-5/6 mx-auto pt-10 pb-20">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-end gap-3">
                <form action="" method="GET" class="flex items-baseline gap-2">
                    <select name="year" class="w-24 mt-2 px-4 border-gray-200 rounded-lg cursor-pointer">

@php
$year = now()->format('Y');
$month = now()->format('n');
$yearParam = request()->input('year') ?? $year;
$monthParam = request()->input('month') ?? $month;
$dayParam = request()->input('day') ?? 0;
$dataParam = request()->input('data') ?? 0;
@endphp
@for ($i = $year; $i >= $year - 1; $i--)
                        <option value="{{ $i }}"@if($i == $yearParam)' selected="selected"'@endif;>{{ $i }}</option>
@endfor

                    </select>
                    年
                    <select name="month" class="w-16 mt-2 px-4 border-gray-200 rounded-lg cursor-pointer">

@for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}"@if($i == $monthParam)' selected="selected"'@endif;>{{ $i }}</option>
@endfor

                    </select>
                    月
                    <input type="submit" value="表示" class="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline" />
                </form>
            </div>

@php
$type = trim(implode(',', config('forms.type')), "'");
$summaryItemName = trim(implode(',', $summaryItems->pluck('name')->all()), "'");
$summaryItemId = trim(implode(',', $summaryItems->pluck('id')->all()), "'");
$shopData = '';
if ($shopDatas->has($dayParam)) {
    $shopData = trim(implode(',', $shopDatas[$dayParam]->toArray()), "'");
}
$sesData = '';
if ($sesDatas->has($dayParam)) {
    if ($sesDatas[$dayParam]->has($dataParam)) {
        $sesData = [
            $sesDatas[$dayParam][$dataParam]->id,
            $sesDatas[$dayParam][$dataParam]->company_name,
            $sesDatas[$dayParam][$dataParam]->personnel_name,
            $sesDatas[$dayParam][$dataParam]->type,
            $sesDatas[$dayParam][$dataParam]->amount,
            $sesDatas[$dayParam][$dataParam]->bank,
            $sesDatas[$dayParam][$dataParam]->irregularFlag
        ];
        $sesData = trim(implode(',', $sesData), "'");
    }
}
$otherData = '';
if ($otherDatas->has($dayParam)) {
    if ($otherDatas[$dayParam]->has($dataParam)) {
        $otherData = [
            $otherDatas[$dayParam][$dataParam]->id,
            $otherDatas[$dayParam][$dataParam]->summary_id,
            $otherDatas[$dayParam][$dataParam]->amount,
            $otherDatas[$dayParam][$dataParam]->type,
            $otherDatas[$dayParam][$dataParam]->bank,
            $otherDatas[$dayParam][$dataParam]->irregularFlag
        ];
        $otherData = trim(implode(',', $otherData), "'");
    }
}

$dayParams = explode(',', $dayParam);
$dataParams = explode(',', $dataParam);
$shopIds = [];
$sesIds = [];
$sesIrregularFlags = [];
$otherIds = [];
$otherIrregularFlags = [];
for ($i = 0; $i < count($dayParams); $i++) {
    if ($shopDatas->has($dayParams[$i])) {
        $shopIds[$i] = $shopDatas[$dayParams[$i]]->id;
    }
    if ($sesDatas->has($dayParams[$i])) {
        if ($sesDatas[$dayParams[$i]]->has($dataParams[$i])) {
            $sesIds[$i] = $sesDatas[$dayParams[$i]][$dataParams[$i]]->id;
            $sesIrregularFlags[$i] = $sesDatas[$dayParams[$i]][$dataParams[$i]]->irregularFlag;
        }
    }
    if ($otherDatas->has($dayParams[$i])) {
        if ($otherDatas[$dayParams[$i]]->has($dataParams[$i])) {
            $otherIds[$i] = $otherDatas[$dayParams[$i]][$dataParams[$i]]->id;
            $otherIrregularFlags[$i] = $otherDatas[$dayParams[$i]][$dataParams[$i]]->irregularFlag;
        }
    }
}
$shopId = trim(implode(',', $shopIds), "'");
$sesId = trim(implode(',', $sesIds), "'");
$sesIrregularFlag = trim(implode(',', $sesIrregularFlags), "'");
$otherId = trim(implode(',', $otherIds), "'");
$otherIrregularFlag = trim(implode(',', $otherIrregularFlags), "'");
@endphp

            <div class="flex gap-1 mt-1">
                <div id="popup-register" data-year-month="{{ $yearParam.'-'.$monthParam }}" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="登録" data-shop-data="{{ $shopData }}" data-ses-data="{{ $sesData }}" data-other-data="{{ $otherData }}"></div>
                <div id="popup-update" data-year-month="{{ $yearParam.'-'.$monthParam }}" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="編集" data-shop-data="{{ $shopData }}" data-ses-data="{{ $sesData }}" data-other-data="{{ $otherData }}"></div>
                <div id="popup-delete" data-year-month="{{ $yearParam.'-'.$monthParam }}" data-shop-id="{{ $shopId }}" data-ses-id="{{ $sesId }}" data-ses-irregular-flag="{{ $sesIrregularFlag }}" data-other-id="{{ $otherId }}" data-other-irregular-flag="{{ $otherIrregularFlag }}"></div>
                <form action="{{ route('cm.download', ['year' => request()->input('year'), 'month' => request()->input('month')]) }}" method="POST">
                    @csrf
                    <button class="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                        <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />  <polyline points="7 11 12 16 17 11" />  <line x1="12" y1="4" x2="12" y2="16" /></svg>
                        ダウンロード
                    </button>
                </form>
                
            </div>
        </div>

        <table class="w-full border-collapse bg-white">
            <thead class="sticky top-0 left-0 bg-white">
                <tr class="text-sm font-medium text-gray-600 text-center">
                    <th class="bg-gray-100"></th>
                    <th class="w-1/12 py-3 border">日付</th>
                    <th colspan="2" class="w-1/6 py-3 border">飲食</th>
                    <th colspan="5" class="w-1/3 py-3 border">SES</th>
                    <th colspan="4" class="w-1/3 py-3 border">その他</th>
                    <th class="w-1/12 py-3 border">実残高</th>
                </tr>
                <tr class="text-xs font-medium text-gray-600 text-center">
                    <th class="bg-gray-100"></th>
                    <th class="p-3 border"></th>
                    <th class="p-3 border">○○店</th>
                    <th class="p-3 border">○○店</th>
                    <th class="p-3 border">会社名</th>
                    <th class="p-3 border">要員名</th>
                    <th class="p-3 border">入金種別</th>
                    <th class="p-3 border">金額</th>
                    <th class="p-3 border">入出金銀行</th>
                    <th class="p-3 border">摘要</th>
                    <th class="p-3 border">金額</th>
                    <th class="p-3 border">入金種別</th>
                    <th class="p-3 border">入出金銀行</th>
                    <th class="p-3 border"></th>
                </tr>
            </thead>
            <tbody>
@for ($i = 1; $i <= $lastDay; $i++)
@php
$bgColor = ($i % 2 === 1) ? 'bg-gray-50 ' : '';
$maxCount = 1;
$sesDataCount = $sesDatas->has($i) ? $sesDatas[$i]->count() : 0;
$otherDataCount = $otherDatas->has($i) ? $otherDatas[$i]->count() : 0;
if ($sesDataCount || $otherDataCount) {
    $maxCount = ($sesDataCount >= $otherDataCount) ? $sesDataCount : $otherDataCount;
}
@endphp
@for ($j = 0; $j < $maxCount; $j++)

                <tr class="{{ $bgColor }}text-xs text-center">
                    <td class="p-3 bg-gray-100"><input type="checkbox" name="date" value="{{ $i }}-{{ $j }}" class="cursor-pointer" /></td>
                    <td class="p-3 border">{{ $i }}</td>

@if ($shopDatas->has($i) && ($j === 0))
                    <td class="p-3 border">{{ number_format($shopDatas[$i]->sales1) }}</td>
                    <td class="p-3 border">{{ number_format($shopDatas[$i]->sales2) }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

@if ($sesDatas->has($i) && ($sesDataCount > $j))
@php
$sesData = $sesDatas[$i][$j]->irregularSesData ?? $sesDatas[$i][$j];
@endphp
                    <td class="p-3 border">{{ $sesData->company_name }}</td>
                    <td class="p-3 border">{{ $sesData->personnel_name }}</td>
                    <td class="p-3 border">{{ config('forms.type')[$sesData->type] }}</td>
                    <td class="p-3 border">{{ number_format($sesData->amount) }}</td>
                    <td class="p-3 border">{{ $sesData->bank }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

@if ($otherDatas->has($i) && ($otherDataCount > $j))
@php
$otherData = $otherDatas[$i][$j]->irregularOtherData ?? $otherDatas[$i][$j];
@endphp
                    <td class="p-3 border">{{ $otherData->summaryItem[0]->name }}</td>
                    <td class="p-3 border">{{ number_format($otherData->amount) }}</td>
                    <td class="p-3 border">{{ config('forms.type')[$otherData->type] }}</td>
                    <td class="p-3 border">{{ $otherData->bank }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

                    <td class="p-3 border">{{ number_format(5000000) }}</td>
                </tr>
@endfor
@endfor

            </tbody>
        </table>
    </div>

</x-app-layout>