<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List users') }}
        </h2>
    </x-slot>

    <table class="w-full mt-5">
        <thead class="uppercase text-black">
            <th scope="col" class="px-6 py-3">#</th>
            <th scope="col" class="px-6 py-3">{{ __("Username") }}</th>
            <th scope="col" class="px-6 py-3">{{ __("Full name") }}</th>
            <th scope="col" class="px-6 py-3">{{ __("Email") }}</th>
            <th scope="col" class="px-6 py-3">{{ __("Action") }}</th>
        </thead>
        <tbody class="bg-white">
            @foreach ($users as $key => $user)
                <tr class="border-b">
                    <th class="px-6 py-4" scope="row text-black">{{ $key }}</th>
                    <td class="px-6 py-4">{{ $user->username }}</td>
                    <td class="px-6 py-4">{{ $user->getFullNameAttribute() }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 flex gap-3 justify-center items-center">
                        @if ($user->is_active)
                            <a href="{{ route('users.show', ['user' => $user]) }}">
                                <button class="w-24 h-12 rounded-md bg-cyan-600 text-white hover:bg-cyan-300 hover:text-gray-600 transition-all">
                                    {{ __("Detail") }}
                                </button>
                            </a>
                            <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                                @csrf
                                @method("put")
                                <input type="hidden" name="is_active" type="boolean" value="0">
                                <button class="w-24 h-12 rounded-md bg-red-600 text-white hover:bg-red-300 hover:text-gray-700 transition-all">
                                    {{ __("Block") }}
                                </button>
                            </form>
                        @else
                            <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                                @csrf
                                @method("put")
                                <input type="hidden" name="is_active" value="1">
                                <button class="w-24 h-12 rounded-md bg-green-600 text-white hover:bg-green-300 hover:text-gray-700 transition-all">
                                    {{ __("Unblock") }}
                                </button>
                            </form>
                        @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-felx justify-content-center">
        {{ $users->links() }}
    </div> 
</x-admin-layout>
