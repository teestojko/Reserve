<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopRepresentative;
use Illuminate\Support\Facades\Hash;

class ShopRepresentativeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.shop_representative_login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $shopRepresentative = ShopRepresentative::where('email', $credentials['email'])->first();
            if (!$shopRepresentative) {
            return back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが一致しません.',
            ]);
            }
            if (!Hash::check($credentials['password'], $shopRepresentative->password)) {
            return back()->withErrors([
                'password' => 'パスワードが一致しません.',
            ]);
            }
            if (Auth::guard('shop_representative')->attempt($credentials)) {
                return redirect()->route('shop_representative.dashboard');
            }
    }
}

