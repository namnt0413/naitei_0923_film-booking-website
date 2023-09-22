<x-app-layout>

    <x-slot name="header">
        @include('layouts.navbar')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <div class="mx-12 mt-5 rounded-md bg-white w-100 min-h-full p-5 flex gap-5">
        <div class="w-1/2 flex flex-col p-5 gap-3 border-r">
            @if (isset($film['avatar'][0]))
                <img src="{{ $film['avatar'][0] }}" alt="{{ $film['title'] }}" class="w-52 h-52" />
            @endif
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold text-lg">{{ __("Title") }}:</p>
                <p class="text-xl">{{ $film['title'] }}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold text-lg">{{ __("Director") }}:</p>
                <p class="text-xl">{{ $film['director'] }}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold text-lg">{{ __("Description") }}:</p>
                <p class="text-xl">{{ $film['description'] }}</p>
            </div>
        </div>
        <div  class="w-1/2 flex flex-col p-5 gap-3">
            <form action="{{ route('tickets.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $film['id'] }}" name="film_id">
                <div class="flex gap-5">
                    <p class="font-bold text-lg">{{ __("Room") }}:</p>
                    <select name="room_id" id="room">
                        <option value="" selected></option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room['id'] }}">{{ $room['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-5 mt-5">
                    <p class="font-bold text-lg">{{ __("List screenings") }}:</p>
                    <div id="screening" class="flex flex-col gap-5"></div>
                </div>
                <div class="flex flex-col gap-5 mt-5">
                    <p class="font-bold text-lg">{{ __("List seats") }}:</p>
                    <div class='flex flex-col' id='seat'>

                    </div>
                </div>

                <button class="mt-5 w-48 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all" type="submit">
                    {{ __("Booking") }}
                </button>
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script src="{{ asset('js/booking.js') }}"></script>
</x-app-layout>
