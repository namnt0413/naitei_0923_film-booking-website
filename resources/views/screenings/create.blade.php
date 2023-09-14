<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create screening') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('screenings.store') }}" method="post">
            @csrf
            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="start">{{ __("Start time") }}</label>
                <input type="text" placeholder="Y-m-d H:i:s" name="start_time" id="start" class="time">
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="end">{{ __("End time") }}</label>
                <input type="text" placeholder="Y-m-d H:i:s" name="end_time" id="end" class="time">
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="total">{{ __("Total") }}</label>
                <input type="number" name="total" id="total" value="1">
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="film">{{ __("Film") }}</label>
                <!-- <input type="" name="film_id" id="film" value="1"> -->
                <select name="film_id" id="film">
                    @foreach ($films as $film)
                        <option value="{{ $film->id }}">{{ $film->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="room">{{ __("Room") }}</label>
                <select name="room_id" id="room">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                {{ __("Create") }}
            </button>
        </form>
    </div>
</x-admin-layout>
