<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class ReservationListController extends Controller
{
    public function reservationList()
    {
        $date = Carbon::now()->toDateString();
        return $this->fetchReservations($date);
    }

    public function changeReservationDate($date)
    {
        return $this->fetchReservations($date);
    }

    private function fetchReservations($date)
    {
        $shop_representative = Auth::guard('shop_representative')->user();
        $shop_id = $shop_representative->shop_id;
        $reservations = Reservation::where('shop_id', $shop_id)
            ->with('user')
            ->whereDate('reservation_date', $date)
            ->paginate(5);
        return view('representative.reservation_list', compact('reservations', 'date'));
    }
}
