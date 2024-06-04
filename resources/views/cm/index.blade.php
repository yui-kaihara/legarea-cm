<x-app-layout>
    <x-slot name="header">CM表</x-slot>
    
    <div class="w-11/12 lg:w-5/6 mx-auto pt-10 pb-20">
        <div class="flex items-end gap-3 mb-2">
            <form action="javascript:void(0)">
                @csrf
                <select name="year" class="w-24 mt-2 px-4 border-gray-200 rounded-lg cursor-pointer is-submit">

@for ($i = 2023; $i <= 2030; $i++)
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

        <table class="border-collapse bg-white">
            <thead>
                <tr class="text-sm font-medium text-gray-600 text-center">
                    <th class="w-1/12 py-3 border">日付</th>
                    <th colspan="2" class="w-1/6 py-3 border">飲食</th>
                    <th colspan="5" class="w-1/3 py-3 border">SES</th>
                    <th colspan="4" class="w-1/3 py-3 border">その他</th>
                    <th class="w-1/12 py-3 border">実残高</th>
                </tr>
                <tr class="text-xs font-medium text-gray-600 text-center">
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
                <tr class="text-xs text-center">
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
</x-app-layout>