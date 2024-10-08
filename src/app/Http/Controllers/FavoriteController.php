<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function toggleFavorite(Shop $shop)
    {
        $user = Auth::user();
            if ($user->favoriteShops->contains($shop)) {
                $user->favoriteShops()->detach($shop);
                return redirect()->back();
            } else {
                $user->favoriteShops()->attach($shop);
                return redirect()->back();
            }
    }
}
