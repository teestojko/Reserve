<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Http\Requests\StoreShopRepresentativeRequest;
use Illuminate\Support\Facades\Hash;

class ShopOwnerCreateController extends Controller
{
    public function create()
    {
        $shops = Shop::all();
        return view('admin.shop_edit', compact('shops'));
    }

    public function store(StoreShopRepresentativeRequest $request)
    {
        ShopRepresentative::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id,
        ]);
        return redirect()->back()->with('success', 'Shop代表者が作成されました');
    }
}
