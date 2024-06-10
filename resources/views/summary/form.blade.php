<div class="md:flex py-10 px-3 justify-center">
    <form action="{{ $route }}" method="POST">
        @csrf
        
<!--予約画面-->
@php
$name = old('name');
@endphp

<!--更新画面-->
@isset($summaryItem)
        @method('PUT')
        
@php
        $name = $summaryItem->name;
@endphp
@endisset

        <div class="flex items-baseline gap-2 mt-4">
            <label for="name" class="w-40 text-sm">項目名</label>
            <div>
                <input type="text" name="name" value="{{ $name }}" class="w-full md:w-96 px-4 border-gray-200 rounded-lg" id="name" />
@error('name')
                <p class="mt-2 text-red-500 text-xs">※{{ $message }}</p>
@enderror
            </div>
        </div>
        <div class="flex justify-center mt-24">
            <input type="submit" value="{{ $submitText }}" class="w-40 cursor-pointer py-3 px-4 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none" />
        </div>
    </form>