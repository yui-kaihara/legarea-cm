<x-app-layout>
    <x-slot name="header">SES 案件登録</x-slot>
    
    @include('ses.form', ['route' => route('ses.store'), 'submitText' => '登録'])

</x-app-layout>