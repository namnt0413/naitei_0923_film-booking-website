<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail seat') }}
        </h2>
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 flex flex-col py-5 px-5 gap-5">
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Seat number") }}: </p>
            <p>{{ $seat->name }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Room name") }}: </p>
            <p>{{ $seat->room->name }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Price") }}: </p>
            <p>{{ $seat->price_ratio }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Type") }}: </p>
            <p>{{ __($seat->type) }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('seats.edit', ['seat' => $seat]) }}">
                <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                    {{ __("Edit") }}
                </button>
            </a>
        </div>
    </div>
</x-admin-layout>
