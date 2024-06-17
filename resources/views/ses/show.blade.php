<x-app-layout>
    <x-slot name="header">SES 案件詳細</x-slot>

@php
$forms = config('forms');
@endphp
    <div class="w-auto md:w-3/5 xl:w-2/5 mx-3 md:mx-auto py-10">
        <div class="flex justify-end gap-2 mb-2">
            <a href="{{ route('ses.index') }}" class="inline-block flex justify-center items-center gap-1 w-24 cursor-pointer py-2 px-3 text-center text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="h-5 w-5"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                一覧
            </a>
            <a href="{{ route('ses.edit', [$sesData]) }}" class="inline-block flex justify-center items-center gap-1 w-24 cursor-pointer py-2 px-3 text-center text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="h-5 w-5"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />  <line x1="16" y1="5" x2="19" y2="8" /></svg>
                編集
            </a>
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
                <th class="p-3 border">金額</th>
                <td class="p-3 border">{{ number_format($sesData->deposit_amount) }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">支払いサイト</th>
                <td class="p-3 border">{{ $forms['paymentSite'][$sesData->deposit_payment_site].'日' }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">土日祝の場合</th>
                <td class="p-3 border">{{ $forms['irregular'][$sesData->deposit_irregular] }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">銀行</th>
                <td class="p-3 border">{{ $sesData->deposit_bank }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th rowspan="4" class="px-3 border">出金</th>
                <th class="p-3 border">金額</th>
                <td class="p-3 border">{{ $withdrawalData ? number_format($withdrawalData->withdrawal_amount).'円' : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">支払いサイト</th>
                <td class="p-3 border">{{ $withdrawalData->withdrawal_payment_site ? $forms['paymentSite'][$withdrawalData->withdrawal_payment_site].'日' : ''; }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">土日祝の場合</th>
                <td class="p-3 border">{{ $withdrawalData->withdrawal_irregular ? $forms['irregular'][$withdrawalData->withdrawal_irregular] : '' }}</td>
            </tr>
            <tr class="text-xs font-medium text-gray-600 text-center">
                <th class="p-3 border">銀行</th>
                <td class="p-3 border">{{ $withdrawalData->withdrawal_bank }}</td>
            </tr>
        </table>
    </div>
</x-app-layout>