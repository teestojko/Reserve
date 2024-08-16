<?php

namespace App\Http\Controllers\ShopRepresentative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShopOwnerCreateRequest;
use Illuminate\Support\Facades\Storage;


class ShopRepresentativeController extends Controller
{
    public function dashboard()
        {
            $shop = Shop::where('id', auth('shop_representative')->user()->shop_id)->first();
            return view('representative/shop_representative_dashboard', compact('shop'));
        }

    public function create()
    {
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        return view('representative/shop_create', compact('prefectures', 'genres'));
    }

    public function store(ShopOwnerCreateRequest $request)
    {
        $shop = new Shop();
        $shop->name = $request->name;

        if ($request->hasFile('image_path')) {
            $filePath = $request->file('image_path')->store('public');
            $shop->image_path = str_replace('public/', 'storage/', $filePath);
        }

        $shop->prefecture_id = $request->prefecture_id;
        $shop->genre_id = $request->genre_id;
        $shop->detail = $request->detail;
        $shop->save();

        return redirect()->route('shop_representative.dashboard')->with('success', '店舗が正常に作成されました。');
    }

    public function verifyReservation(Request $request)
    {
        $reservationId = $request->input('reservationId');
        $reservation = Reservation::find($reservationId);

        if ($reservation) {
            // 予約が見つかった場合の処理
            return response()->json(['status' => 'success', 'message' => 'Reservation verified']);
        } else {
            // 予約が見つからなかった場合の処理
            return response()->json(['status' => 'error', 'message' => 'Reservation not found']);
        }
    }
}
