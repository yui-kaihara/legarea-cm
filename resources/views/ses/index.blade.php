<x-app-layout>
    <x-slot name="header">SES 案件一覧</x-slot>
    
    <div class="w-1/2 mx-auto py-10">
        <table class="text-xs text-center">
            <thead>
                <tr class="bg-gray-200 font-medium text-gray-600">
                    <th class="w-1/4 py-3">会社名</th>
                    <th class="w-1/4 py-3">案件名</th>
                    <th class="w-1/4 py-3">要員名</th>
                    <th class="w-1/4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="w-1/4 py-3 px-1">CompanyA</td>
                    <td class="w-1/4 py-3 px-1">案件1</td>
                    <td class="w-1/4 py-3 px-1">田中</td>
                    <td class="w-1/4 py-3 px-1">
                        <div class="flex items-center gap-0.5 text-xs">
                            <a href="" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow no-underline">
                                詳細
                            </a>
                            <a href="" class="bg-white hover:bg-gray-100 text-gray-500 font-semibold py-2 px-2 border border-gray-400 rounded shadow no-underline">
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
            </tbody>
        </table>
    </div>
</x-app-layout>