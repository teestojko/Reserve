@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/send_email.css') }}">
@endsection

@section('content')
<div class="send_email">
    <div class="send_email_inner">
        <div class="send_email_title">
            全てのユーザーにメール送信
        </div>
        <div class="send_email_content">
            <form class="content_form" action="{{ route('admin.send_email') }}" method="POST">
            @csrf
                <div class="send_email_section">
                    <div class="section_title">
                        件名
                    </div>
                    <div class="send_email_message">
                        <label for="subject" ></label>
                        <input type="text" name="subject" id="subject" placeholder="件名を入力してください">
                    </div>
                </div>
                @error('subject')
                    <div class="alert_danger_comment">
                        {{ $message }}
                    </div>
                @enderror
                <div class="send_email_section">
                    <div class="section_title">
                        メッセージ
                    </div>
                    <div class="send_email_message2">
                        <label class="message" for="message"></label>
                        <textarea name="message" id="message" rows="5"></textarea>
                    </div>
                </div>
                @error('message')
                    <div class="alert_danger_comment2">
                        {{ $message }}
                    </div>
                @enderror
                <div class="send_email_button">
                    <button class="send_email_button_button" type="submit">
                        送信する
                    </button>
                </div>
            </form>
            <div class="send_email_back_button">
                <a class="send_email_back_button_link" href="{{ route('admin.dashboard')}}">
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
</div>
@endsection
