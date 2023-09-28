<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit room') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('rooms.update', ['room' => $room]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2" for="room">{{ __("Room name") }}</label>
                <input type="text" placeholder="{{ __('Room name') }}" name="name" id="room" value="{{ $room->name }}">
            </div>

            <div class="my-8">
                <label class="block text-lg font-bold mb-2" for="image">{{ __("Room image") }}</label>
                <img class="object-cover bg-cover h-80 w-auto px-10 py-5" src="{{ $room->image }}"/>
                <input type="file" name="image" id="image"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-green-700
                    hover:file:bg-violet-100"
                />
            </div>

            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                {{ __("Edit") }}
            </button>
        </form>
    </div>
</x-admin-layout>
