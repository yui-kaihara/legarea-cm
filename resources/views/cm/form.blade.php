<div class="hidden absolute top-1/4 left-1/4 w-1/2 mx-auto p-7 bg-white rounded-lg shadow-md text-xs is-show">
    <p class="mb-5 font-semibold">2024-06-02</p>
    <form action="" method="POST">
        <div class="mb-10">
            <span class="font-semibold">飲食</span>
            <div class="flex gap-3 mt-2">
                <label for="">
                    ○○店
                    <input type="number" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
                <label for="">
                    ○○店
                    <input type="number" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
            </div>
        </div>
        <div class="mb-10">
            <span class="font-semibold">SES</span>
            <div class="flex gap-3 mt-2">
                <label for="">
                    会社名
                    <input type="text" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
                <label for="">
                    要員名
                    <input type="text" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
                <label for="">
                    入金種別
                    <select name="type" class="block w-20 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" id="type">
                        <option value=""></option>

@foreach (config('forms.type') as $index => $value)
                        <option value="{{ $index }}"@if($index == $index)' selected="selected"'@endif>{{ $value }}</option>
@endforeach

                    </select>
                </label>
                <label for="">
                    金額
                    <input type="number" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
                <label for="">
                    入出金銀行
                    <input type="text" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
            </div>
        </div>
        <div>
            <span class="font-semibold">その他</span>
            <div class="flex gap-3 mt-2">
                <label for="">
                    摘要
                    <select name="summary_id" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" id="summary_id">
                        <option value=""></option>

@foreach ($summaryItems as $summaryItem)
                        <option value="{{ $summaryItem->id }}"@if($summaryItem->id == $summaryItem->id)' selected="selected"'@endif>{{ $summaryItem->name }}</option>
@endforeach

                    </select>
                </label>
                <label for="">
                    金額
                    <input type="number" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
                <label for="">
                    入金種別
                    <select name="type" class="block w-20 mt-1 px-4 border-gray-200 rounded-lg text-xs cursor-pointer" id="type">
                        <option value=""></option>

@foreach (config('forms.type') as $index => $value)
                        <option value="{{ $index }}"@if($index == $index)' selected="selected"'@endif>{{ $value }}</option>
@endforeach

                    </select>
                </label>
                <label for="">
                    入出金銀行
                    <input type="text" name="" value="" class="block w-36 mt-1 px-4 border-gray-200 rounded-lg text-xs" id="" />
                </label>
            </div>
        </div>
        <div class="flex justify-center mt-20">
            <input type="submit" value="{{ $submitText }}" class="w-32 cursor-pointer py-3 px-4 font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
        </div>
    </form>
</div>