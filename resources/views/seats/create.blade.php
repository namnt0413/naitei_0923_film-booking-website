<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create seat') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('seats.store') }}" method="post">
            @csrf
            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="name">{{ __("Seat name") }}</label>
                <input type="text" placeholder="{{ __('Seat name') }}" name="name" id="name">
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="room">{{ __("Room name") }}</label>
                <select name="room_id" id="room">
                    @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="price">{{ __("Price") }}</label>
                <input type="number" step="0.01" placeholder="{{ __('Price') }}" name="price_ratio" id="price">
            </div>

            <div class="mb-2">
                <label class="block text-lg font-bold mb-2" for="type">{{ __("Type") }}</label>
                <select name="type" id="type">
                    <option value="normal">{{ __('Normal') }}</option>
                    <option value="couple">{{ __('Couple') }}</option>
                    <option value="vip">{{ __('Vip') }}</option>
                </select>
            </div>

            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                {{ __("Create") }}
            </button>
        </form>
    </div>
</x-admin-layout>
