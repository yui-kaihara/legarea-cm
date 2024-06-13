<x-app-layout>
    <x-slot name="header">SES 案件詳細</x-slot>

@php
$forms = config('forms');
@endphp
    <div class="w-auto md:w-3/5 xl:w-2/5 mx-3 md:mx-auto py-10">
        <div class="flex justify-end gap-2 mb-2">
            <a href="{{ route('ses.index') }}" class="inline-block w-24 cursor-pointer py-2 px-3 text-center text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">一覧</a>
            <a href="{{ route('ses.edit', [$sesData]) }}" class="inline-block w-24 cursor-pointer py-2 px-3 text-center text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">編集</a>
        </div>
        <table class="w-full border-collapse bg-white">
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th rowspan="5" class="px-3 border"></th>
                <th class="p-3 border w-1/3">会社名</th>
                <td class="p-3 border w-2/3">{{ $sesData->company_name }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">案件名</th>
                <td class="p-3 border">{{ $sesData->case_name }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">要員名</th>
                <td class="p-3 border">{{ $sesData->personnel_name }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">入場日</th>
                <td class="p-3 border">{{ $sesData->admission_date->format('Y-m-d') }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">退場日</th>
                <td class="p-3 border">{{ ($sesData->exit_date) ? $sesData->exit_date->format('Y-m-d') : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th rowspan="4" class="px-3 border">入金</th>
                <th class="p-3 border">入金金額</th>
                <td class="p-3 border">{{ $sesData->deposit_amount ? number_format($sesData->deposit_amount).'円' : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">支払いサイト</th>
                <td class="p-3 border">{{ $sesData->payment_site ? $forms['paymentSite'][$sesData->payment_site].'日' : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">入金日が土日祝の場合</th>
                <td class="p-3 border">{{ $sesData->deposit_irregular ? $forms['irregular'][$sesData->deposit_irregular] : '' }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">入金銀行</th>
                <td class="p-3 border">{{ $sesData->deposit_bank }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th rowspan="4" class="px-3 border">出金</th>
                <th class="p-3 border">出金金額</th>
                <td class="p-3 border">{{ $sesData->withdrawal_amount ? number_format($sesData->withdrawal_amount).'円' : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">出金日</th>
                <td class="p-3 border">{{ $sesData->withdrawal_date ? $sesData->withdrawal_date.'日' : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">出金日が土日祝の場合</th>
                <td class="p-3 border">{{ $sesData->withdrawal_irregular ? $forms['irregular'][$sesData->withdrawal_irregular] : '' }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">出金銀行</th>
                <td class="p-3 border">{{ $sesData->withdrawal_bank }}</td>
            </tr>
        </table>
    </div>
</x-app-layout>