@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment_thanks.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="reserve_content">
        <div class="reserve_main">
            <div class="reserve_thanks_massage">
                ご予約ありがとうございます
            </div>
            <a class="return_my_page" href="/my_page/{shop}">
                戻る
            </a>
        </div>
        <div class="nav_content">
            <a class="reserve_nav" href="{{ route('payment.show') }}">
                支払いに進む
            </a>
        </div>
    </div>
@endsection
