<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create room') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('rooms.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2" for="room">{{ __("Room name") }}</label>
                <input type="text" placeholder="{{ __('Room name') }}" name="name" id="room" />
            </div>

            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                {{ __("Create") }}
            </button>
        </form>
    </div>
</x-admin-layout>
