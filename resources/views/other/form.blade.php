<div class="md:flex py-10 px-3 justify-center">
    <form action="{{ $route }}" method="POST">
        @csrf
        
<!--予約画面-->
@php
$summaryId = old('summary_id');
$amount = old('amount');
$type = old('type');
$date = old('date');
$irregular = old('irregular');
$bank = old('bank');
@endphp

<!--更新画面-->
@isset($otherData)
        @method('PUT')
        
@php
        $summary = $otherData->summary;
        $amount = $otherData->amount;
        $type = $otherData->type;
        $date = $otherData->date;
        $irregular = $otherData->irregular;
        $bank = $otherData->bank;
@endphp
@endisset

        <div class="flex items-baseline gap-2">
            <label for="summary_id" class="w-40 text-sm">摘要</label>
            <div>
                <select name="summary_id" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="summary_id">

                    <option value=""></option>

                </select>
@error('summary_id')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="amount" class="w-40 text-sm">金額</label>
            <div>
                <input type="number" name="amount" value="{{ $amount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="amount" /> 円
@error('amount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="type" class="w-40 text-sm">入金種別</label>
            <div>
                <select name="type" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="type">

@foreach (config('forms.type') as $index => $type)
                    <option value="{{ $index }}"@if($type == $index)' selected="selected"'@endif>{{ $type }}</option>
@endforeach

                </select>
@error('type')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="date" class="w-40 text-sm">入出金日</label>
            <div>
                <select name="date" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="date">
                    <option value=""></option>

@for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}"@if($date == $i)' selected="selected"';@endif>{{ $i }}</option>
@endfor

                </select>
                日
@error('date')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="irregular" class="w-40 text-sm">入出金日が土日祝の場合</label>
            <div>
                <select name="irregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="irregular">

@foreach (config('forms.irregular') as $index => $value)
                    <option value="{{ $index }}"@if($irregular == $index)' selected="selected"';@endif>{{ $value }}</option>
@endforeach

                </select>
@error('irregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="bank" class="w-40 text-sm">入出金銀行</label>
            <div>
                <input type="text" name="bank" value="{{ $bank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="bank" />
@error('bank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex justify-center mt-24">
            <input type="submit" value="{{ $submitText }}" class="w-40 cursor-pointer py-3 px-4 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
        </div>
    </form>