<x-app-layout>
    <x-slot name="header">SES 案件一覧</x-slot>

@if (session('flash_message'))
    <p class="px-4 py-3 bg-blue-100 text-blue-800 text-center font-semibold text-sm md:text-base">
        {{ session('flash_message') }}
    </p>
@endif
    
    <div class="w-1/2 mx-auto py-10">
        <div class="flex justify-end mb-3">
            <a href="{{ route('ses.create') }}" class="flex items-center gap-1 cursor-pointer py-2 px-4 text-sm font-semibold rounded border border-gray-400 bg-white text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none no-underline">
                <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="16" height="16" rx="2" />  <line x1="9" y1="12" x2="15" y2="12" />  <line x1="12" y1="9" x2="12" y2="15" /></svg>
                新規登録
            </a>
        </div>
        <table class="text-xs text-center">
            <thead>
                <tr class="bg-gray-200 font-medium text-gray-600">
                    <th class="w-32 py-3">会社名</th>
                    <th class="w-56 py-3">案件名</th>
                    <th class="w-32 py-3">要員名</th>
                    <th class="w-32 py-3">ステータス</th>
                    <th class="w-40 py-3"></th>
                </tr>
            </thead>
            <tbody>
@php
$status = config('status');
@endphp
@foreach ($sesDatas as $sesData)
                <tr>
                    <td class="w-32 py-3 px-1">{{ $sesData->company_name }}</td>
                    <td class="w-56 py-3 px-1">{{ $sesData->case_name }}</td>
                    <td class="w-32 py-3 px-1">{{ $sesData->personnel_name }}</td>
                    <td class="w-32 py-3 px-1"><span class="inline-block w-16 px-2 py-1 bg-{{ $status[$sesData->status]['color'] }}-200 rounded">{{ $status[$sesData->status]['text'] }}</span></td>
                    <td class="w-40 py-3 px-1">
                        <div class="flex items-center gap-0.5 text-xs">
                            <a href="{{ route('ses.show', [$sesData]) }}" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow no-underline">
                                詳細
                            </a>
                            <a href="{{ route('ses.edit', [$sesData]) }}" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow no-underline">
                                編集
                            </a>
                            <form action="" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="削除" onclick="return confirm('本当に削除しますか？')" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow cursor-pointer" />
                            </form>
                        </div>
                    </td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>