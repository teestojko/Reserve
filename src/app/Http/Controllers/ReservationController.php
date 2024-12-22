<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ReservationEditRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
{
    $user_id = Auth::id();
    $shop_id = $request->shop_id;
    $date = $request->reservation_date;
    $existingReservation = Reservation::where('user_id', $user_id)
        ->where('shop_id', $shop_id)
        ->whereDate('reservation_date', $date)
        ->first();
    if ($existingReservation) {
        return redirect()->back()->withErrors(['error' => '同じ日付にこのショップに既に予約があります。']);
    }
    $data = $request->all();
    $data['user_id'] = $user_id;
    Reservation::create($data);
    return redirect()->route('payment.thanks');
}

    public function showThanksPage()
    {
        return view('payment.payment_thanks');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('edit', compact('reservation'));
    }

    public function update(ReservationEditRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $user_id = Auth::id();
        $shop_id = $request->shop_id;
        $newDate = $request->reservation_date;
        $existingReservation = Reservation::where('user_id', $user_id)
            ->where('shop_id', $shop_id)
            ->whereDate('reservation_date', $newDate)
            ->where('id', '!=', $id)
            ->first();
        if ($existingReservation) {
            return redirect()->back()->withErrors(['error' => 'その日には既にこのショップに予約があります。']);
        }
        $reservation->update($request->all());
        return redirect()->back()->with('success', '予約が変更されました。');
    }
}
