<x-app-layout>
    <x-slot name="header">
        @include('layouts.navbar')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-5">
            {{ __('Booked Tickets') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 mt-5 mb-16">
        @if ($tickets->count() > 0)
        <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($tickets as $ticket)
            <div class="flex flex-row bg-white p-4 rounded-lg shadow-md">
                <div class="basis-3/12 p-2">
                    <img src="{{ $ticket->film->medias->where('type', 'avatar')->first()->link }}" />
                </div>
                <div class="basis-9/12 p-2">
                    <h2 class="text-xl font-semibold mb-2">{{ $ticket->film->title }}</h2>
                    <p class="text-gray-600">{{ __('Screening') }}: {{ $ticket->screening->start_time }} - {{ $ticket->screening->end_time }}</p>
                    <p class="text-gray-600">{{ __('Booking date') }}: {{ $ticket->created_at->format('d/m/Y') }}</p>
                    <p class="text-gray-600">{{ __('Seat number') }}: {{ $ticket->seat->name }}</p>
                    <p class="text-gray-600">{{ __('Room') }}: {{ $ticket->seat->room->name }}</p>
                    <p class="text-gray-600">{{ __('Price') }}: {{ number_format($ticket->price) }}</p>
                    <div class="flex flex-row justify-end">
                        <a href="{{ route('tickets.detail', ['ticket' => $ticket]) }}">
                            <button class="w-20 h-8 rounded-md bg-red-600 text-white hover:bg-red-300 hover:text-gray-700 transition-all">{{ __('Detail') }}</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p>{{ __('No tickets booked') }}</p>
        @endif
    </div>
    @include('layouts.footer')
</x-app-layout>
