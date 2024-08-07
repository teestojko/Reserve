@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
<div class="register_content">
    <div class="register_detail">
        <div class="register_form">
            <div class="register_form_heading">
                <div class="register_title">registration</div>
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
                    <button class="form_button_submit" type="submit">登録</button>
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
{{-- <div class="register__content">
  <div class="register-form__heading">
    <h2>会員登録</h2>
  </div>
    <form class="form" action="/register" method="post">
        @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="name" value="{{ old('name') }}" />
        </div>
        <div class="form__error">
          @error('name')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" value="{{ old('email') }}" />
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">パスワード</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password" />
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">確認用パスワード</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password_confirmation" />
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">登録</button>
    </div>
  </form>
  <div class="login__link">
    <a class="login__button-submit" href="/login">ログインの方はこちら</a>
  </div>
</div> --}}
@endsection
