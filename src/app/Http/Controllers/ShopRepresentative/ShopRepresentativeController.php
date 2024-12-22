<?php

namespace App\Http\Controllers\ShopRepresentative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShopUpdateRequest;
use Illuminate\Support\Facades\Storage;


class ShopRepresentativeController extends Controller
{
    public function dashboard()
        {
            $shop = Shop::where('id', auth('shop_representative')->user()->shop_id)->first();
            return view('representative.shop_representative_dashboard', compact('shop'));
        }

    public function create()
    {
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        return view('representative.shop_create', compact('prefectures', 'genres'));
    }

    public function store(ShopUpdateRequest $request)
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
}
