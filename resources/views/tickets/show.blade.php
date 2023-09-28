<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail ticket') }}
        </h2>
    </x-slot>

    <div class="bg-white w-full border-gray-500 rounded-lg mt-5 flex flex-col py-5 px-5 gap-5">
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Film") }}: </p>
            <p>{{ $ticket->film->title }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("User") }}: </p>
            <p>{{ $ticket->user->getFullNameAttribute() }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Room") }}: </p>
            <p>{{ $ticket->screening->room->name }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Seat number") }}: </p>
            <p>{{ $ticket->seat->name }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Time") }}: </p>
            <p>{{ $ticket->screening->start_time }} {{ $ticket->screening->end_time }}</p>
        </div>
        <div class="flex gap-5">
            <p class="uppercase font-bold">{{ __("Price") }}: </p>
            <p>{{ $ticket->price }}</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('tickets.edit', ['ticket' => $ticket]) }}">
                <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                    {{ __("Edit") }}
                </button>
            </a>
        </div>
    </div>
</x-admin-layout>
