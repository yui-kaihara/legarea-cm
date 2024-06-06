<div class="md:flex py-10 px-3 justify-center">
    <form action="{{ $route }}" method="POST">
        @csrf
        
<!--予約画面-->
@php
$company_name = old('company_name');
$case_name = old('case_name');
$personnel_name = old('personnel_name');
$deposit_amount = old('deposit_amount');
$payment_site = old('payment_site');
$deposit_irregular = old('deposit_irregular');
$deposit_bank = old('deposit_bank');
$withdrawal_amount = old('withdrawal_amount');
$withdrawal_date = old('withdrawal_date');
$withdrawal_irregular = old('withdrawal_irregular');
$withdrawal_bank = old('withdrawal_bank');
$admission_date = old('admission_date');
$exit_date = old('exit_date');
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
            <label for="company_name" class="w-40 text-sm font-medium">会社名</label>
            <div>
                <input type="text" name="company_name" value="{{ $company_name }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="company_name" />
@error('company_name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="case_name" class="w-40 text-sm font-medium">案件名</label>
            <div>
                <input type="text" name="case_name" value="{{ $case_name }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="case_name" />
@error('case_name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="personnel_name" class="w-40 text-sm font-medium">要員名</label>
            <div>
                <input type="text" name="personnel_name" value="{{ $personnel_name }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="personnel_name" />
@error('personnel_name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="admission_date" class="w-40 text-sm font-medium">入場日</label>
            <div>
                <input type="date" name="admission_date" value="{{ $admission_date }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="admission_date" />
@error('admission_date')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="exit_date" class="w-40 text-sm font-medium">退場日</label>
            <input type="date" name="exit_date" value="{{ $exit_date }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="exit_date" />
        </div>
        
        <span class="inline-block mt-16 px-5 py-1 bg-gray-400 rounded-sm text-white text-xs font-normal">入金</span>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="deposit_amount" class="w-40 text-sm font-medium">入金金額</label>
            <div>
                <input type="number" name="deposit_amount" value="{{ $deposit_amount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="deposit_amount" /> 円
@error('deposit_amount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="payment_site" class="w-40 text-sm font-medium">支払いサイト</label>
            <div>
                <select name="payment_site" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="payment_site">
                    <option value=""></option>

@foreach (config('paymentSite') as $key => $term)
@php
$selected = (old('payment_site') == $key) ? ' selected="selected"' : '';
@endphp
                    <option value="{{ $key }}"{{ $selected }}>{{ $term }}</option>
@endforeach

                </select>
@error('payment_site')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="deposit_irregular" class="w-40 text-sm font-medium">入金日が土日祝の場合</label>
            <div>
                <select name="deposit_irregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="deposit_irregular">
                    <option value=""></option>
                    <option value="1">前</option>
                    <option value="2">後</option>
                </select>
@error('deposit_irregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="deposit_bank" class="w-40 text-sm font-medium">入金銀行</label>
            <div>
                <input type="text" name="deposit_bank" value="{{ $deposit_bank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="deposit_bank" />
@error('deposit_bank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        
        <span class="inline-block mt-16 px-5 py-1 bg-gray-400 rounded-sm text-white text-xs font-normal">出金</span>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawal_amount" class="w-40 text-sm font-medium">出金金額</label>
            <div>
                <input type="number" name="withdrawal_amount" value="{{ $withdrawal_amount }}" class="w-36 px-4 border-gray-200 rounded-lg" id="withdrawal_amount" /> 円
@error('withdrawal_amount')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawal_date" class="w-40 text-sm font-medium">出金日</label>
            <div>
                <select name="withdrawal_date" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="withdrawal_date">
                    <option value=""></option>

@for ($i = 1; $i <= 31; $i++)
@php
$selected = (old('withdrawal_date') == $i) ? ' selected="selected"' : '';
@endphp
                    <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
@endfor

                </select>
                日
@error('withdrawal_date')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawal_irregular" class="w-40 text-sm font-medium">出金日が土日祝の場合</label>
            <div>
                <select name="withdrawal_irregular" class="w-20 px-4 border-gray-200 rounded-lg cursor-pointer" id="withdrawal_irregular">
                    <option value=""></option>
                    <option value="1">前</option>
                    <option value="2">後</option>
                </select>
@error('withdrawal_irregular')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex items-baseline gap-2 mt-6">
            <label for="withdrawal_bank" class="w-40 text-sm font-medium">出金銀行</label>
            <div>
                <input type="text" name="withdrawal_bank" value="{{ $withdrawal_bank }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="withdrawal_bank" />
@error('withdrawal_bank')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex justify-center mt-24">
            <input type="submit" value="{{ $submitText }}" class="w-40 cursor-pointer py-3 px-4 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
        </div>
    </form>