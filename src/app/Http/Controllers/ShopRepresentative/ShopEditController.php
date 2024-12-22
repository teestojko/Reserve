<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ShopUpdateRequest;

class ShopEditController extends Controller
{
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        return view('representative.shop_update', compact('shop', 'prefectures', 'genres'));
    }

    public function update(ShopUpdateRequest $request, $id)
    {
        $shop = Shop::findOrFail($id);
            if ($request->hasFile('image_path')) {
                if ($shop->image_path && Storage::exists($shop->image_path)) {
                    Storage::delete($shop->image_path);
                }
        $path = $request->file('image_path')->store('public');
        $shop->image_path = str_replace('public/', 'storage/', $path);
        }
        $shop->update([
            'name' => $request->name,
            'prefecture_id' => $request->prefecture_id,
            'genre_id' => $request->genre_id,
            'detail' => $request->detail,
        ]);
        return redirect()->route('shop_representative.dashboard')->with('success', '店舗情報が更新されました');
    }
}
