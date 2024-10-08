<?php 
use function Livewire\Volt\{state, mount};
use function Livewire\Volt\rules;
use App\Models\Domain;

state([
    'domain' => ''
]);

// mount(function () {
//     dd('oi');
// });

$saveForm = function () {
    // dd($this);
    $this->validate([
        'domain' => 'string'
    ]);

    Domain::create([
        'name' => $this->domain
    ]);

    $this->domain = '';
}

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class='md:grid md:grid-cols-3 md:gap-6'>
                    <x-section-title>
                        <x-slot name="title"> Domain Information</x-slot>
                        <x-slot name="description">
                            Please enter the domain details below.
                        </x-slot>
                    </x-section-title>
                    {{-- </div> --}}
        
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form wire:submit="saveForm">
                            <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow sm:rounded-md">
                            {{-- <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}"> --}}
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="domain" value="Domain Name" />
                                        <x-input id="domain" wire:model='domain' name="domain" type="text" class="mt-1 block w-full" />
                                    </div>
                                </div>
                            </div>
        
                            {{-- @if (isset($actions)) --}}
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                {{-- {{ $actions }} --}}
                                {{-- <button type="submit" class="btn btn-primary">
                                    Save
                                </button> --}}
                                <x-button type="submit" class="btn btn-ghost">
                                    Save
                                </x-button>
                            </div>
                            {{-- @endif --}}
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div> --}}
        </div>
    </div>
</x-app-layout>
