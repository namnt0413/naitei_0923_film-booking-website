<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail screening') }}
        </h2>
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 flex flex-col py-5 px-5 gap-5">
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Start time") }}: </p>
            <p>{{ $screening->start_time }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("End time") }}: </p>
            <p>{{ $screening->end_time }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Total") }}: </p>
            <p>{{ $screening->total }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Remain") }}: </p>
            <p>{{ $screening->remain }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Film") }}: </p>
            <p>{{ $screening->film->title }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Room") }}: </p>
            <p>{{ $screening->room->name }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('screenings.edit', ['screening' => 1]) }}">
                <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                    {{ __("Edit") }}
                </button>
            </a>
            <a href="{{ route('screenings.index') }}">
                <button class="w-24 h-12 rounded-md bg-slate-700 text-white hover:bg-slate-300 hover:text-gray-700 transition-all">
                    {{ __("Back") }}
                </button>
            </a>
        </div>
    </div>
</x-admin-layout>
