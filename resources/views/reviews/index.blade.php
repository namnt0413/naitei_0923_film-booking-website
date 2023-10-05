<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List reviews') }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-5 gap-5">
        <table class="w-full">
            <thead class="uppercase text-black">
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">{{ __("Content") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("Film") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("User") }}</th>
                <th scope="col" class="px-6 py-3">{{ __("Action") }}</th>
            </thead>
            <tbody class="bg-white">
                @foreach ($reviews as $key => $review)
                    <tr class="border-b">
                        <th class="px-6 py-4" scope="row text-black">{{ $key + 1 }}</th>
                        <td class="px-6 py-4 text-center">{{ $review->comment }}</td>
                        <td class="px-6 py-4 text-center">{{ $review->film->title }}</td>
                        <td class="px-6 py-4 text-center">{{ $review->user->getFullNameAttribute() }}</td>
                        <td class="px-6 py-4 flex gap-3 justify-center items-center">
                            <a href="{{ route('reviews.show', ['review' => $review]) }}">
                                <button class="w-24 h-12 rounded-md bg-cyan-600 text-white hover:bg-cyan-300 hover:text-gray-600 transition-all">
                                    {{ __("Detail") }}
                                </button>
                            </a>
                            <form action="{{ route('reviews.destroy', ['review' => $review]) }}" method="post">
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
            {{ $reviews->links() }}
        </div>
    </div>
</x-admin-layout>
