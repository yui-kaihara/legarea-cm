<x-app-layout>
    <x-slot name="header">その他 摘要編集</x-slot>
    
    @include('other.form', ['route' => route('other.update', [$otherData]), 'submitText' => '更新'])

</x-app-layout>