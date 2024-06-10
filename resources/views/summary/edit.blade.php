<x-app-layout>
    <x-slot name="header">摘要項目編集</x-slot>
    
    @include('summary.form', ['route' => route('summary.update', [$summaryItem]), 'submitText' => '更新'])

</x-app-layout>