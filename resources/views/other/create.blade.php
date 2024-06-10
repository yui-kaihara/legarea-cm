<x-app-layout>
    <x-slot name="header">その他 摘要登録</x-slot>
    
    @include('other.form', ['route' => route('other.store'), 'submitText' => '登録'])

</x-app-layout>