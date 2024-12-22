<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewRequest;


class ReviewController extends Controller
{

    public function review(Shop $shop)
    {
        return view('reviews.review', compact('shop'));
    }

    public function store(ReviewRequest $request, Shop $shop)
    {
        $existingReview = Review::where('user_id', Auth::id())
            ->where('shop_id', $shop->id)
            ->first();
            if ($existingReview) {
                return redirect()->back()->withErrors(['custom_error' => '既にこの店舗にレビューを投稿しています。']);
            }
        $review = new Review();
        $review->user_id = Auth::id();
        $review->shop_id = $shop->id;
        $review->comment = $request->comment;
        $review->stars = $request->stars;
        $review->save();
        return back()
        ->with('success', 'レビューを投稿しました');
    }

    public function index(Shop $shop)
    {
        $reviews = Review::where('shop_id', $shop->id)
            ->where('user_id', Auth::id())
            ->get();
        return view('reviews.reviews_index', compact('reviews', 'shop'));
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            return response()->json(['error' => 'この操作を実行する権限がありません。'], 403);
        }
        $review->delete();
        return back()->with('success', 'レビューを削除しました');
    }
}
