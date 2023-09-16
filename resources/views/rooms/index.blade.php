<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List rooms') }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-5 gap-5">
        <div>
            <a href="{{ route('rooms.create') }}">
                <button class="w-48 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                    {{ __("Create room") }}
                </button>
            </a>
        </div>

        <table class="w-full">
            <thead class="uppercase text-black">
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">{{ __("Name Room") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("Action") }}</th>
            </thead>
            <tbody class="bg-white">
                @foreach ($rooms as $room)
                    <tr class="border-b">
                        <th class="px-6 py-4" scope="row text-black">{{ $room->id }}</th>
                        <td class="px-6 py-4 text-center">{{ $room->name }}</td>
                        <td class="px-6 py-4 flex gap-3 justify-center items-center">
                            <a href="{{ route('rooms.show', ['room' => $room]) }}">
                                <button class="w-24 h-12 rounded-md bg-cyan-600 text-white hover:bg-cyan-300 hover:text-gray-600 transition-all">
                                    {{ __("Detail") }}
                                </button>
                            </a>
                            <a href="{{ route('rooms.edit', ['room' => $room]) }}">
                                <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                                    {{ __("Edit") }}
                                </button>
                            </a>
                            <form action="{{ route('rooms.destroy', ['room' => $room]) }}" method="post">
                                @csrf
                                @method("delete")
                                <button class="w-24 h-12 rounded-md bg-red-600 text-white hover:bg-red-300 hover:text-gray-700 transition-all">
                                    {{ __("Delete") }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-felx justify-content-center">
            {{ $rooms->links() }}
        </div>
    </div>
</x-admin-layout>
