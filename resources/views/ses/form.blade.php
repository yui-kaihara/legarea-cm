<div class="md:flex py-10 px-3 justify-center">
    <form action="{{ $route }}" method="POST">
        @csrf
        
<!--予約画面-->
@php
$companyName = old('company_name');
$caseName = old('case_name');
$personnelName = old('personnel_name');
$admissionDate = old('admission_date');
$exitDate = old('exit_date');
$depositAmount = old('deposit_amount');
$depositPaymentSite = old('deposit_payment_site');
$depositIrregular = old('deposit_irregular');
$depositBank = old('deposit_bank');
$withdrawalAmount = old('withdrawal_amount');
$withdrawalPaymentSite = old('withdrawal_payment_site');
$withdrawalIrregular = old('withdrawal_irregular');
$withdrawalBank = old('withdrawal_bank');
$depositId = '';
@endphp

<!--更新画面-->
@isset($sesData)
        @method('PUT')
        
@php
        $companyName = $sesData->company_name;
        $caseName = $sesData->case_name;
        $personnelName = $sesData->personnel_name;
        $admissionDate = $sesData->admission_date->format('Y-m-d');
        $exitDate = $sesData->exit_date ? $sesData->exit_date->format('Y-m-d') : '';
        $depositAmount = $sesData->deposit_amount;
        $depositPaymentSite = $sesData->deposit_payment_site;
        $depositIrregular = $sesData->deposit_irregular;
        $depositBank = $sesData->deposit_bank;
        $withdrawalAmount = $withdrawalData->withdrawal_amount;
        $withdrawalPaymentSite = $withdrawalData->withdrawal_payment_site;
        $withdrawalIrregular = $withdrawalData->withdrawal_irregular;
        $withdrawalBank = $withdrawalData->withdrawal_bank;
        $depositId = $withdrawalData->deposit_id;
@endphp
@endisset

        <div class="flex items-baseline gap-2">
            <label for="company_name" class="w-40 text-sm">会社名</label>
            <div>
                <input type="text" name="company_name" value="{{ $companyName }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="company_name" />
@error('company_name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="case_name" class="w-40 text-sm">案件名</label>
            <div>
                <input type="text" name="case_name" value="{{ $caseName }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="case_name" />
@error('case_name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="personnel_name" class="w-40 text-sm">要員名</label>
            <div>
                <input type="text" name="personnel_name" value="{{ $personnelName }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="personnel_name" />
@error('personnel_name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="admission_date" class="w-40 text-sm">入場日</label>
            <div>
                <input type="date" name="admission_date" value="{{ $admissionDate }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="admission_date" />
@error('admission_date')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="exit_date" class="w-40 text-sm">退場日</label>
            <input type="date" name="exit_date" value="{{ $exitDate }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="exit_date" />
        </div>
        
        <span class="inline-block mt-16 px-5 py-1 bg-gray-400 rounded-sm text-white text-xs font-medium">入金</span>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="deposit_amount" class="w-40 text-sm">金額</label>
            <div>
                <input type="number" name="deposit_amount" value="{{ $depositAmount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="deposit_amount" /> 円
@error('deposit_amount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="deposit_payment_site" class="w-40 text-sm">支払いサイト</label>
            <div>
                <select name="deposit_payment_site" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="deposit_payment_site">
                    <option value=""></option>

@foreach (config('forms.paymentSite') as $key => $term)
                    <option value="{{ $key }}"@if($depositPaymentSite == $key)' selected="selected"';@endif>{{ $term }}日</option>
@endforeach

                </select>
@error('deposit_payment_site')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="deposit_irregular" class="w-40 text-sm">土日祝の場合</label>
            <div>
                <select name="deposit_irregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="deposit_irregular">
                    <option value=""></option>

@foreach (config('forms.irregular') as $index => $value)
                    <option value="{{ $index }}"@if($depositIrregular == $index)' selected="selected"';@endif>{{ $value }}</option>
@endforeach

                </select>
@error('deposit_irregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="deposit_bank" class="w-40 text-sm">銀行</label>
            <div>
                <input type="text" name="deposit_bank" value="{{ $depositBank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="deposit_bank" />
@error('deposit_bank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        
        <span class="inline-block mt-16 px-5 py-1 bg-gray-400 rounded-sm text-white text-xs font-medium">出金</span>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="withdrawal_amount" class="w-40 text-sm">金額</label>
            <div>
                <input type="number" name="withdrawal_amount" value="{{ $withdrawalAmount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="withdrawal_amount" /> 円
@error('withdrawal_amount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="withdrawal_payment_site" class="w-40 text-sm">支払いサイト</label>
            <div>
                <select name="withdrawal_payment_site" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="withdrawal_payment_site">
                    <option value=""></option>

@foreach (config('forms.paymentSite') as $key => $term)
                    <option value="{{ $key }}"@if($withdrawalPaymentSite == $key)' selected="selected"';@endif>{{ $term }}日</option>
@endforeach

                </select>
@error('withdrawal_payment_site')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="withdrawal_irregular" class="w-40 text-sm">土日祝の場合</label>
            <div>
                <select name="withdrawal_irregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="withdrawal_irregular">
                    <option value=""></option>

@foreach (config('forms.irregular') as $index => $value)
                    <option value="{{ $index }}"@if($withdrawalIrregular == $index)' selected="selected"';@endif>{{ $value }}</option>
@endforeach

                </select>
@error('withdrawal_irregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-4">
            <label for="withdrawal_bank" class="w-40 text-sm">銀行</label>
            <div>
                <input type="text" name="withdrawal_bank" value="{{ $withdrawalBank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="withdrawal_bank" />
@error('withdrawal_bank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex justify-center mt-24">
            <input type="submit" value="{{ $submitText }}" class="w-40 cursor-pointer py-3 px-4 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
        </div>
    </form>