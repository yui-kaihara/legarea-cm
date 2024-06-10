<x-app-layout>
    <x-slot name="header">摘要項目登録</x-slot>
    
    @include('summary.form', ['route' => route('summary.store'), 'submitText' => '登録'])

</x-app-layout>