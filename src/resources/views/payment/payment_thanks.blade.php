@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/payment_thanks.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="reserve_content">
        <div class="reserve_main">
            <div class="reserve_thanks_massage">
                ご予約ありがとうございます。
            </div>
            <div class="reserve_button_content">
                <a class="reserve_button" href="/">
                    戻る
                </a>
            </div>
            <div class="nav_content">
                <a class="reserve_nav" href="{{ route('redirect.to.payment') }}">
                    支払いに進む
                </a>
            </div>
            <div>
                <div class="qr_title">
                    この画面を保存して、来店時に以下のQRコードを提示してください
                </div>
                <div>
                    {!! $qrCode !!}
                </div>
            </div>
        </div>
    </div>
@endsection