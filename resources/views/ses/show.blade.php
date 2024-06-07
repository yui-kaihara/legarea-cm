<x-app-layout>
    <x-slot name="header">SES 案件詳細</x-slot>
    
    <div class="w-auto md:w-3/5 xl:w-2/5 mx-3 md:mx-auto py-10">
        <div class="flex justify-end gap-2 mb-2">
            <a href="{{ route('ses.index') }}" class="inline-block w-24 cursor-pointer py-2 px-3 text-center text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">一覧</a>
            <a href="{{ route('ses.edit', [$sesData]) }}" class="inline-block w-24 cursor-pointer py-2 px-3 text-center text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">編集</a>
        </div>
        <dl class="block py-8 px-4 md:px-8 bg-white border border-gray-200 rounded-lg shadow text-left text-sm">
            <div class="flex items-baseline md:items-center gap-10">
                <dt class="w-1/3">会社名</dt>
                <dd class="w-2/3 md:text-base">{{ $sesData->company_name }}</dd>
            </div>
            <div class="flex items-baseline gap-10 mt-4">
                <dt class="w-1/3">案件名</dt>
                <dd class="w-2/3 md:text-base">{{ $sesData->case_name }}</dd>
            </div>
            <div class="flex items-baseline gap-10 mt-4">
                <dt class="w-1/3">要員名</dt>
                <dd class="w-2/3 md:text-base">{{ $sesData->personnel_name }}</dd>
            </div>
            <div class="flex items-baseline gap-10 mt-4">
                <dt class="w-full mt-5">
                    <span class="inline-block px-5 py-1 bg-gray-400 rounded-sm text-white text-xs font-medium">入金</span>
                    <dl>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">入金金額</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->deposit_amount ? number_format($sesData->deposit_amount).'円' : ''; }}</dd>
                        </div>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">支払いサイト</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->payment_site ? config('paymentSite')[$sesData->payment_site].'日' : ''; }}</dd>
                        </div>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">入金日が土日祝の場合</dt>
                            <dd class="w-2/3 md:text-base">{{ config('irregular')[$sesData->deposit_irregular] }}</dd>
                        </div>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">入金銀行</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->deposit_bank }}</dd>
                        </div>
                    </dl>
                </dt>
            </div>
            <div class="flex items-baseline gap-10 mt-4">
                <dt class="w-full mt-5">
                    <span class="inline-block px-5 py-1 bg-gray-400 rounded-sm text-white text-xs font-medium">出金</span>
                    <dl>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">出金金額</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->withdrawal_amount ? number_format($sesData->withdrawal_amount).'円' : ''; }}</dd>
                        </div>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">出金日</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->withdrawal_date }}</dd>
                        </div>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">出金日が土日祝の場合</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->withdrawal_irregular ? config('irregular')[$sesData->withdrawal_irregular].'日' : ''; }}</dd>
                        </div>
                        <div class="flex items-baseline gap-10 mt-4">
                            <dt class="w-1/3">出金銀行</dt>
                            <dd class="w-2/3 md:text-base">{{ $sesData->withdrawal_bank }}</dd>
                        </div>
                    </dl>
                </dt>
            </div>
        </dl>
    </div>
</x-app-layout>