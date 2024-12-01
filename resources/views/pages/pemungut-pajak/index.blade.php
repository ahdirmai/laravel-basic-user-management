<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>


    <x-slot name="header">
        Pemungut Pajak Index page
    </x-slot>
    <div class="row">
        Hello {{ Auth::user()->name }} - {{ Auth::user()->getRoleNames()->first() }}
    </div>


</x-app-layout>