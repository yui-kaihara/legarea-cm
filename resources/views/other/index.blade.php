<x-app-layout>
    <x-slot name="header">その他 摘要一覧</x-slot>
    
@if (session('flash_message'))
    <p class="px-4 py-3 bg-blue-100 text-blue-800 text-center font-semibold text-sm md:text-base">
        {{ session('flash_message') }}
    </p>
@endif
    
    <div class="w-2/3 mx-auto py-10">
        <div class="flex justify-end mb-2">
            <a href="{{ route('other.create') }}" class="flex justify-center items-center gap-1 w-32 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="16" height="16" rx="2" />  <line x1="9" y1="12" x2="15" y2="12" />  <line x1="12" y1="9" x2="12" y2="15" /></svg>
                新規登録
            </a>
        </div>
        <div class="flex justify-end mb-3">
            <a href="{{ route('summary.index') }}" class="flex justify-center items-center gap-1 w-32 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                <svg class="h-5 w-5"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="3" />  <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" /></svg>
                摘要項目
            </a>
        </div>
        <table class="w-full text-xs text-center">
            <thead>
                <tr class="bg-gray-200 font-medium text-gray-600">
                    <th class="w-40 py-3">摘要</th>
                    <th class="w-40 py-3">金額</th>
                    <th class="w-40 py-3">入金種別</th>
                    <th class="w-40 py-3">入出金日</th>
                    <th class="w-40 py-3">土日祝の場合</th>
                    <th class="w-40 py-3">開始月</th>
                    <th class="w-40 py-3">入出金銀行</th>
                    <th class="w-40 py-3">終了月</th>
                    <th class="w-40 py-3"></th>
                </tr>
            </thead>
            <tbody>

@php
$forms = config('forms');
@endphp
@foreach ($otherDatas as $otherData)
                <tr>
                    <td class="w-40 py-3 px-1">{{ $otherData->summaryItem[0]->name }}</td>
                    <td class="w-40 py-3 px-1">{{ number_format($otherData->amount) }}</td>
                    <td class="w-40 py-3 px-1">{{ $forms['type'][$otherData->type] }}</td>
                    <td class="w-40 py-3 px-1">{{ $otherData->date }}日</td>
                    <td class="w-40 py-3 px-1">{{ $forms['irregular'][$otherData->irregular] }}</td>
                    <td class="w-40 py-3 px-1">{{ $otherData->start_month }}</td>
                    <td class="w-40 py-3 px-1">{{ $otherData->bank }}</td>
                    <td class="w-40 py-3 px-1">{{ $otherData->end_month }}</td>
                    <td class="w-40 py-3 px-1">
                        <div class="flex items-center gap-0.5 text-xs">
                            <a href="{{ route('other.edit', [$otherData]) }}" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow no-underline">
                                編集
                            </a>
                            <form action="{{ route('other.destroy', [$otherData]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="削除" onclick="return confirm('削除しますか？')" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow cursor-pointer" />
                            </form>
                        </div>
                    </td>
                </tr>
@endforeach

            </tbody>
        </table>
    </div>
</x-app-layout> 