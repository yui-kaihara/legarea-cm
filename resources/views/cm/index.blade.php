<x-app-layout>
    <x-slot name="header">CM表</x-slot>
    
    <div class="w-11/12 lg:w-5/6 mx-auto pt-10 pb-20">
        <div class="flex justify-between mb-2">
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
            <div>
                <a href="" class="flex justify-center items-center gap-1 w-32 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">ダウンロード</a>
                <div class="flex gap-1 mt-1">
                    
@php
$type = trim(implode(',', config('forms.type')), "'");
$summaryItemName = trim(implode(',', $summaryItems->pluck('name')->all()), "'");
$summaryItemId = trim(implode(',', $summaryItems->pluck('id')->all()), "'");
@endphp

                    <div id="popup" data-type="{{ $type }}" data-summary-item-name="{{ $summaryItemName }}" data-summary-item-id="{{ $summaryItemId }}" data-submit-text="編集"></div>
                    <a href="" class="flex justify-center items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">削除</a>
                </div>
            </div>
        </div>

        <table class="w-full border-collapse bg-white">
            <thead>
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
                <tr class="bg-gray-50 text-xs text-center">
                    <td class="p-3 bg-gray-100"><input type="checkbox" class="cursor-pointer" /></td>
                    <td class="p-3 border">1</td>
                    <td class="p-3 border">{{ number_format(50000) }}</td>
                    <td class="p-3 border">{{ number_format(50000) }}</td>
                    <td class="p-3 border">CompanyA</td>
                    <td class="p-3 border">田中</td>
                    <td class="p-3 border">入金</td>
                    <td class="p-3 border">{{ number_format(10000) }}</td>
                    <td class="p-3 border">三井</td>
                    <td class="p-3 border">弁護士</td>
                    <td class="p-3 border">10000</td>
                    <td class="p-3 border">出金</td>
                    <td class="p-3 border">GMO</td>
                    <td class="p-3 border">{{ number_format(5000000) }}</td>
                </tr>
                <tr class="text-xs text-center">
                    <td class="p-3 bg-gray-100"><input type="checkbox" class="cursor-pointer" /></td>
                    <td class="p-3 border">1</td>
                    <td class="p-3 border">50000</td>
                    <td class="p-3 border">50000</td>
                    <td class="p-3 border">CompanyA</td>
                    <td class="p-3 border">田中</td>
                    <td class="p-3 border">入金</td>
                    <td class="p-3 border">100000</td>
                    <td class="p-3 border">三井</td>
                    <td class="p-3 border">弁護士</td>
                    <td class="p-3 border">10000</td>
                    <td class="p-3 border">出金</td>
                    <td class="p-3 border">GMO</td>
                    <td class="p-3 border">5000000</td>
                </tr>
                <tr class="bg-gray-50 text-xs text-center">
                    <td class="p-3 bg-gray-100"><input type="checkbox" class="cursor-pointer" /></td>
                    <td class="p-3 border">1</td>
                    <td class="p-3 border">50000</td>
                    <td class="p-3 border">50000</td>
                    <td class="p-3 border">CompanyA</td>
                    <td class="p-3 border">田中</td>
                    <td class="p-3 border">入金</td>
                    <td class="p-3 border">100000</td>
                    <td class="p-3 border">三井</td>
                    <td class="p-3 border">弁護士</td>
                    <td class="p-3 border">10000</td>
                    <td class="p-3 border">出金</td>
                    <td class="p-3 border">GMO</td>
                    <td class="p-3 border">5000000</td>
                </tr>
            </tbody>
        </table>
    </div>

    @include('cm.form', ['route' => route('cm.store'), 'submitText' => '登録'])

</x-app-layout>