@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="login_content">
        <div class="login_detail">
            <div class="login_form">
                <div class="login_form_heading">
                    <div class="login_title">
                        Login
                    </div>
                </div>
                <form class="form" action="{{ route('login') }}" method="post">
                    @csrf
                        <div class="form_group_content">
                            <div class="form_input_text">
                                <i class="fas fa-envelope fa-xl" ></i>
                                <input class="email_input" type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                            </div>
                        </div>
                        <div class="form_group_content2">
                            <div class="form_input_text">
                                <i class="fa-solid fa-lock fa-xl"></i>
                                <input class="password_input" type="password" name="password" placeholder="Password"/>
                            </div>
                        </div>
                    <div class="form_button">
                        <button class="form_button_submit" type="submit">
                            ログイン
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="form_error">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <div class="form_error">
            @error('password')
                {{ $message }}
            @enderror
        </div>
        <div class="login_buttons">
            <a href="{{ route('admin.login') }}" class="login_button admin_button">
                管理者ログイン
            </a>
            <a href="{{ route('shop_representative.login') }}" class="login_button shop_representative_button">
                店舗代表者ログイン
            </a>
        </div>
    </div>
@endsection
