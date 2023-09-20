<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List tickets') }}
        </h2>
    </x-slot>

    <table class="w-full mt-5">
        <thead class="uppercase text-black">
            <th scope="col" class="px-6 py-3">#</th>
            <th scope="col" class="px-6 py-3">{{ __("Film") }}</th>
            <th scope="col" class="px-6 py-3">{{ __("Room") }}</th>
            <th scope="col" class="px-6 py-3">{{ __("Seat number") }}</th>
            <th scope="col" class="px-6 py-3">{{ __("Action") }}</th>
        </thead>
        <tbody class="bg-white">
            @foreach ($tickets as $key => $ticket)
                <tr class="border-b">
                    <th class="px-6 py-4" scope="row text-black">{{ $key }}</th>
                    <td class="px-6 py-4">{{ $ticket->film->title }}</td>
                    <td class="px-6 py-4">{{ $ticket->screening->room->name }}</td>
                    <td class="px-6 py-4">{{ $ticket->seat->number }}</td>
                    <td class="px-6 py-4 flex gap-3 justify-center items-center">
                        <a href="{{ route('tickets.show', ['ticket' => $ticket]) }}">
                            <button class="w-24 h-12 rounded-md bg-cyan-600 text-white hover:bg-cyan-300 hover:text-gray-600 transition-all">
                                {{ __("Detail") }}
                            </button>
                        </a>
                        <a href="{{ route('tickets.edit', ['ticket' => $ticket]) }}">
                            <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                                {{ __("Edit") }}
                            </button>
                        </a>
                        <form action="{{ route('tickets.destroy', ['ticket' => $ticket]) }}" method="post">
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
        {{ $tickets->links() }}
    </div> 
</x-admin-layout>
