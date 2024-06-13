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
                <form action="javascript:void(0)">
                    @csrf
                    <select name="year" class="w-24 mt-2 px-4 border-gray-200 rounded-lg cursor-pointer is-submit">

@php
$year = now()->format('Y');
@endphp
@for ($i = $year - 1; $i <= $year; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
@endfor

                    </select>
                    年
                </form>
                <form action="javascript:void(0)">
                    @csrf
                    <select name="month" class="w-16 mt-2 px-4 border-gray-200 rounded-lg cursor-pointer is-submit">

@for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
@endfor

                    </select>
                    月
                </form>
            </div>

@php
$type = trim(implode(',', config('forms.type')), "'");
$summaryItemName = trim(implode(',', $summaryItems->pluck('name')->all()), "'");
$summaryItemId = trim(implode(',', $summaryItems->pluck('id')->all()), "'");
@endphp

            <div class="flex gap-1 mt-1">
                <div id="popup-register" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="登録"></div>
                <div id="popup-update" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="編集"></div>
                <a href="" class="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">削除</a>
                <a href="" class="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">ダウンロード</a>
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
@for ($i = 1; $i <= 31; $i++)
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
                    <td class="p-3 bg-gray-100"><input type="checkbox" class="cursor-pointer" /></td>
                    <td class="p-3 border">{{ $i }}</td>

@if ($shopDatas->has($i))
                    <td class="p-3 border">{{ number_format($shopDatas[$i]->sales1) }}</td>
                    <td class="p-3 border">{{ number_format($shopDatas[$i]->sales2) }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

@if ($sesDatas->has($i))
                    <td class="p-3 border">{{ $sesDatas[$i][$j]->company_name }}</td>
                    <td class="p-3 border">{{ $sesDatas[$i][$j]->personnel_name }}</td>
                    <td class="p-3 border">{{ ($sesDatas[$i][$j]->deposit_amount) ? '入金' : '出金'; }}</td>
                    <td class="p-3 border">{{ ($sesDatas[$i][$j]->deposit_amount) ? number_format($sesDatas[$i][$j]->deposit_amount) : number_format($sesDatas[$i][$j]->withdrawal_amount); }}</td>
                    <td class="p-3 border">{{ ($sesDatas[$i][$j]->deposit_bank) ?? ($sesDatas[$i][$j]->withdrawal_bank); }}</td>
@else
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
                    <td class="p-3 border"></td>
@endif

@if ($otherDatas->has($i))
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