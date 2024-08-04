<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReservationListController extends Controller
{
    public function reservationList()
    {
        $shopRepresentative = Auth::guard('shop_representative')->user();

        $shopId = $shopRepresentative->shop_id;

        $reservations = Reservation::where('shop_id', $shopId)->with('user')->get();

        return view('representative.reservation-list', compact('reservations'));
    }
}
