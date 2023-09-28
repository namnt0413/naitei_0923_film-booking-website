<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create room') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-5 mt-5">
        <form action="{{ route('rooms.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-lg font-bold mb-2" for="room">{{ __("Room name") }}</label>
                <input type="text" placeholder="{{ __('Room name') }}" name="name" id="room" />
            </div>

            <div class="my-8">
                <label class="block text-lg font-bold mb-2" for="image">{{ __("Room image") }}</label>
                <input type="file" name="image" id="image"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-green-700
                    hover:file:bg-violet-100"
                />
            </div>

            <button type="submit" class="w-24 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                {{ __("Create") }}
            </button>
        </form>
    </div>
</x-admin-layout>
