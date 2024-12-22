@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop_edit.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="shop_edit">
        <div class="shop_edit_inner">
            <div class="inner_title">
                店舗代表者作成画面
            </div>
            <form class="inner_form" method="POST" action="{{ route('admin.store') }}">
            @csrf
                <div class="shop_edit_name_content">
                    <div class="content_title">
                        名前
                    </div>
                    <div class="input">
                        <label for="name"></label>
                        <input type="text" name="name" id="name">
                    </div>
                </div>
                @error('name')
                    <div class="alert_danger_comment1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_edit_email_content">
                    <div class="content_title">
                        Email
                    </div>
                    <div class="input">
                        <label for="email"></label>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                @error('email')
                    <div class="alert_danger_comment2">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_edit_password_content">
                    <div class="content_title">
                        パスワード
                    </div>
                    <div class="input">
                        <label for="password"></label>
                        <input type="password" name="password" id="password">
                    </div>
                </div>
                @error('password')
                    <div class="alert_danger_comment3">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_edit_confirm_content">
                    <div class="content_title">
                        確認パスワード
                    </div>
                    <div class="input">
                        <label for="password_confirmation"></label>
                        <input type="password" name="password_confirmation" id="password_confirm">
                    </div>
                </div>
                @error('password_confirmation')
                    <div class="alert_danger_comment4">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_edit_shop_content">
                    <div class="content_title">
                        Shop
                    </div>
                    <div class="input">
                        <label for="shop_id"></label>
                        <select name="shop_id" id="shop_id">
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">
                                    {{ $shop->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('shop_id')
                    <div class="alert_danger_comment5">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_edit_button">
                    <button class="shop_edit_button_button" type="submit">
                        作成する
                    </button>
                </div>
            </form>
            <div class="shop_edit_back_button">
                <a class="shop_edit_back_button_link" href="{{ route('admin.dashboard')}}">
                    戻る
                </a>
            </div>
            @if (session('success'))
                <p class="success_message">
                    {{ session('success') }}
                </p>
            @endif
        </div>
    </div>
@endsection
