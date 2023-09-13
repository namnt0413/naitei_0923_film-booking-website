<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List screenings') }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-5 gap-5">
        <div>
            <a href="{{ route('screenings.create') }}">
                <button class="w-48 h-12 text-lg rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-600 transition-all">
                    {{ __("Create screen") }}
                </button>
            </a>
        </div>

        <table class="w-full">
            <thead class="uppercase text-black">
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">{{ __("Start time") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("End time") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("Film") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("Action") }}</th>
            </thead>
            <tbody class="bg-white">
                @foreach ($screenings as $screening)
                    <tr class="border-b">
                        <th class="px-6 py-4" scope="row text-black">{{ $screening->id }}</th>
                        <td class="px-6 py-4">{{ $screening->start_time }}</td>
                        <td class="px-6 py-4">{{ $screening->end_time }}</td>
                        <td class="px-6 py-4">{{ $screening->film->title }}</td>
                        <td class="px-6 py-4 flex gap-3 justify-center items-center">
                            <a href="{{ route('screenings.show', ['screening' => $screening]) }}">
                                <button class="w-24 h-12 rounded-md bg-cyan-600 text-white hover:bg-cyan-300 hover:text-gray-600 transition-all">
                                    {{ __("Detail") }}
                                </button>
                            </a>
                            <a href="{{ route('screenings.edit', ['screening' => $screening]) }}">
                                <button class="w-24 h-12 rounded-md bg-blue-600 text-white hover:bg-blue-300 hover:text-gray-600 transition-all">
                                    {{ __("Edit") }}
                                </button>
                            </a>
                            <form action="{{ route('screenings.destroy', ['screening' => $screening]) }}" method="post">
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
            {{ $screenings->links() }}
        </div>
    </div>
</x-admin-layout>
