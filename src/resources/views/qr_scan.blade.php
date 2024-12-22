@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/qr_scan.css') }}">
@endsection

@section('content')
    <div>
        <div class="qr_title">
            この画面を保存して、来店時に以下のQRコードを提示してください
        </div>
        <div class="qr_code">
            {!! $qrCode !!}
        </div>
    </div>
    <a class="return_my_page" href="/my_page/{shop}">
        マイページへ戻る
    </a>
@endsection
