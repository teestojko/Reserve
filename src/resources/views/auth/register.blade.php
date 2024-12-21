@extends('Layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="register_content">
        <div class="register_detail">
            <div class="register_form">
                <div class="register_form_heading">
                    <div class="register_title">
                        registration
                    </div>
                </div>
                <form class="form" action="/register" method="post">
                @csrf
                    <div class="form_group_content">
                        <div class="form_input_text">
                            <i class="fas fa-user fa-xl"></i>
                            <input class="email_input" type="text" name="name" value="{{ old('name') }}" placeholder="Username"/>
                        </div>
                        <div class="form_input_text">
                            <i class="fas fa-envelope fa-xl" ></i>
                            <input class="email_input" type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form_group_content3">
                        <div class="form_input_text">
                            <i class="fa-solid fa-lock fa-xl"></i>
                            <input class="password_input" type="password" name="password" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form__button">
                        <button class="form_button_submit" type="submit">
                            登録
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="form_error">
            @error('name')
                {{ $message }}
            @enderror
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
    </div>
@endsection
