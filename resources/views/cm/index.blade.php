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
$sesData = '';
if ($sesDatas->has($dayParam)) {
    $sesData = trim(implode(',', $sesDatas[$dayParam]->all()), "'");
}
@endphp

            <div class="flex gap-1 mt-1">
                <div id="popup-register" data-year-month="{{ $yearParam.'-'.$monthParam }}" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="登録" data-ses-data="{{ $sesData }}"></div>
                <div id="popup-update" data-year-month="{{ $yearParam.'-'.$monthParam }}" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="編集" data-ses-data="{{ $sesData }}"></div>
                <a href="" class="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                    <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    削除
                </a>
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
                    <td class="p-3 bg-gray-100"><input type="checkbox" name="date" value="{{ $i }}-{{ $j }}" class="cursor-pointer is-check" /></td>
                    <td class="p-3 border">{{ $i }}</td>

@if ($shopDatas->has($i) && ($j === 0))
                    <td class="p-3 border">{{ number_format($shopDatas[$i]->sales1) }}</td>
                    <td class="p-3 border">{{ number_format($shopDatas[$i]->sales2) }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

@if ($sesDatas->has($i) && ($sesDataCount > $j))
                    <td class="p-3 border">{{ $sesDatas[$i][$j]->company_name }}</td>
                    <td class="p-3 border">{{ $sesDatas[$i][$j]->personnel_name }}</td>
                    <td class="p-3 border">{{ config('forms.type')[$sesDatas[$i][$j]->type] }}</td>
                    <td class="p-3 border">{{ number_format($sesDatas[$i][$j]->amount) }}</td>
                    <td class="p-3 border">{{ $sesDatas[$i][$j]->bank }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

@if ($otherDatas->has($i) && ($otherDataCount > $j))
                    <td class="p-3 border">{{ $otherDatas[$i][$j]->summaryItem[0]->name }}</td>
                    <td class="p-3 border">{{ number_format($otherDatas[$i][$j]->amount) }}</td>
                    <td class="p-3 border">{{ config('forms.type')[$otherDatas[$i][$j]->type] }}</td>
                    <td class="p-3 border">{{ $otherDatas[$i][$j]->bank }}</td>
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