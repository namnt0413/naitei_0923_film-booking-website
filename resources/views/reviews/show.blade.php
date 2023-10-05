<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail review and comment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-8 bg-white rounded-md mt-5 border">
        <table class="text-lg mb-8">
            <tr>
                <td class="w-36 border-r">{{ __("Film") }}:</td>
                <td class="pl-12">{{ $review->film->title }}:</td>
            </tr>
            <tr>
                <td class="border-r">{{ __("User") }}:</td>
                <td class="pl-12">{{ $review->user->getFullNameAttribute() }}</td>
            </tr>
            <tr>
                <td class="border-r">{{ __("Comment") }}:</td>
                <td class="pl-12">{{ $review->comment }}</td>
            </tr>
            <tr>
                <td class="border-r">{{ __("Star rating") }}:</td>
                <td class="pl-12">
                    @for ($i = 1; $i <= $review->rating; $i++)
                        <i class="fa-solid fa-star" style="color: #ffc107;margin: 3px 3px 0;"></i>
                    @endfor
                </td>
            </tr>
        </table>
        <a href="{{ route('reviews.index') }}">
            <button class="w-24 h-12 rounded-md bg-slate-700 text-white hover:bg-slate-300 hover:text-gray-700 transition-all">
                {{ __("Back") }}
            </button>
        </a>        
    </div>
</x-admin-layout>
