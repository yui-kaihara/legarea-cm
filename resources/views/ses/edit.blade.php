<x-app-layout>
    <x-slot name="header">SES 案件編集</x-slot>
    
    @include('ses.form', ['route' => route('ses.update', [$sesData]), 'submitText' => '更新'])

</x-app-layout>