<div class="md:flex py-10 px-3 justify-center">
    <form action="{{ $route }}" method="POST">
        @csrf
        
<!--予約画面-->
@php
$companyName = old('companyName');
$caseName = old('caseName');
$personnelName = old('personnelName');
$depositAmount = old('depositAmount');
$paymentSite = old('paymentSite');
$depositIrregular = old('depositIrregular');
$depositBank = old('depositBank');
$withdrawalAmount = old('withdrawalAmount');
$withdrawalDate = old('withdrawalDate');
$withdrawalIrregular = old('withdrawalIrregular');
$withdrawalBank = old('withdrawalBank');
$admissionDate = old('admissionDate');
$exitDate = old('exitDate');
@endphp

<!--更新画面-->
@isset($event)
        @method('PUT')
        
@php
        $times = $event->times;
        $date = $event->date->format('Y-m-d');
        $startTime = $event->start_time->format('H:i');
        $endTime = $event->end_time->format('H:i');
        $place = $event->place;
        $amount = $event->amount;
        $capacity = $event->capacity;
@endphp
@endisset

        <div class="flex items-baseline gap-2">
            <label for="companyName" class="w-40 text-sm font-medium">会社名</label>
            <div>
                <input type="text" name="companyName" value="{{ $companyName }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="companyName" />
@error('companyName')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="caseName" class="w-40 text-sm font-medium">案件名</label>
            <div>
                <input type="text" name="caseName" value="{{ $caseName }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="caseName" />
@error('caseName')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="personnelName" class="w-40 text-sm font-medium">要員名</label>
            <div>
                <input type="text" name="personnelName" value="{{ $personnelName }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="personnelName" />
@error('personnelName')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="depositAmount" class="w-40 text-sm font-medium">入金金額</label>
            <div>
                <input type="number" name="depositAmount" value="{{ $depositAmount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="depositAmount" /> 円
@error('depositAmount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="paymentSite" class="w-40 text-sm font-medium">支払いサイト</label>
            <div>
                <select name="paymentSite" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="paymentSite">
@foreach (config('paymentSite') as $key => $term)
@php
$selected = (old('paymentSite') == $key) ? ' selected="selected"' : '';
@endphp
                    <option value="{{ $key }}"{{ $selected }}>{{ $term }}</option>
@endforeach
                </select>
@error('paymentSite')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="depositIrregular" class="w-40 text-sm font-medium">入金日が土日祝の場合</label>
            <div>
                <select name="depositIrregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="depositIrregular">
                    <option value="1">前</option>
                    <option value="2">後</option>
                </select>
@error('depositIrregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="depositBank" class="w-40 text-sm font-medium">入金銀行</label>
            <div>
                <input type="text" name="depositBank" value="{{ $depositBank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="depositBank" />
@error('depositBank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawalAmount" class="w-40 text-sm font-medium">出金金額</label>
            <div>
                <input type="number" name="withdrawalAmount" value="{{ $withdrawalAmount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="withdrawalAmount" /> 円
@error('withdrawalAmount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawalDate" class="w-40 text-sm font-medium">出金日</label>
            <div>
                <select name="withdrawalDate" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="withdrawalDate">
@for ($i = 1; $i <= 31; $i++)
@php
$selected = (old('withdrawalDate') == $i) ? ' selected="selected"' : '';
@endphp
                    <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
@endfor
                </select>
                日
@error('withdrawalDate')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawalIrregular" class="w-40 text-sm font-medium">出金日が土日祝の場合</label>
            <div>
                <select name="withdrawalIrregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="withdrawalIrregular">
                    <option value="1">前</option>
                    <option value="2">後</option>
                </select>
@error('withdrawalIrregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawalBank" class="w-40 text-sm font-medium">出金銀行</label>
            <div>
                <input type="text" name="withdrawalBank" value="{{ $withdrawalBank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="withdrawalBank" />
@error('withdrawalBank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="admissionDate" class="w-40 text-sm font-medium">入場日</label>
            <div>
                <input type="date" name="admissionDate" value="{{ $admissionDate }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="admissionDate" />
@error('admissionDate')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="exitDate" class="w-40 text-sm font-medium">退場日</label>
            <input type="date" name="exitDate" value="{{ $exitDate }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="exitDate" />
        </div>
        <div class="flex justify-center mt-24">
            <input type="submit" value="{{ $submitText }}" class="w-40 cursor-pointer py-3 px-4 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
        </div>
    </form>