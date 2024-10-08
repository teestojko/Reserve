<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Genre;
use App\Models\Prefecture;
use Carbon\Carbon;

class MyPageController extends Controller
{
    public function showMyPage($id)
    {
    $user = Auth::user();
    $favorites = $user->favoriteShops()->with('genre', 'prefecture')->get();
    $all_reservations = Reservation::where('user_id', $user->id)
        ->orderBy('reservation_date', 'asc')
        ->orderBy('reservation_time', 'asc')
        ->get();
    return view('my_page', compact('user', 'favorites', 'all_reservations'));
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation && $reservation->user_id == Auth::id()) {
            $shopId = $reservation->shop_id;
            $reservation->delete();
        }
        return redirect()->route('myPage', ['shop' => $shopId]);
    }
}
