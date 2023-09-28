<x-app-layout>
    <x-slot name="header">
        @include('layouts.navbar')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-5">
            {{ __('Detail Ticket') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-12">
        <div class="bg-lime-200 rounded-lg shadow p-8">
            <div class="flex flex-row mb-3">
                <div class="basis-3/12 p-2">
                    <img src="{{ $ticket->film->medias->where('type', 'avatar')->first()->link }}" />
                </div>
                <div class="basis-9/12 p-6">
                    <h1 class="text-4xl font-semibold mb-2">{{ $ticket->film->title }}</h1>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Room') }}: {{ $ticket->seat->room->name }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Screening') }}: {{ $ticket->screening->start_time }} - {{ $ticket->screening->start_time }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Seat number') }}: {{ $ticket->seat->name }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Genres') }}: {{ $ticket->film->genres->first()->name }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Director') }}: {{ $ticket->film->director }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Year of manufacture') }}: {{ $ticket->film->release_date }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Duration') }}: {{ $ticket->film->duration }} {{ __('minitues') }}</p>
                    <p class="text-xl text-gray-600 mb-2">{{ __('Booking date') }}: {{ $ticket->created_at }}</p>
                    <div class="flex flex-row justify-end">
                        <form action="{{ route('tickets.destroy', ['ticket' => $ticket]) }}" method="post">
                            @csrf
                            @method("delete")
                            <button class="w-20 h-8 rounded-md bg-red-600 text-white hover:bg-red-300 hover:text-gray-700 transition-all">
                                {{ __("Cancel") }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <h2 class="text-2xl font-semibold uppercase mb-2">{{ __('Description of movie content') }}</h2>
                <p>{{ $ticket->film->description }}</p>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
