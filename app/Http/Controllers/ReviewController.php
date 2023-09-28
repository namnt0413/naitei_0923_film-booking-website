<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Review\CreateRequest;
use App\Http\Requests\Review\UpdateRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        $user_id = Auth::user()->id;
        Review::create(array_merge($validated, ["user_id" => $user_id]));

        return redirect()->back()->with('success', trans('Successfully created'));
    }

    public function update(UpdateRequest $request, Review $review)
    {
        $validated = $request->validated();
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->save();

        return redirect()->back()->with('success', trans('Successfully updated'));
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', trans('Successfully deleted'));
    }
}
