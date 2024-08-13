@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/Representative/shop_representative_dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
<div class="content">
    <div class="detail">
        <div class="top">
            shop_owner Dashboard
        </div>
        @if (session('success'))
            <p>
                {{ session('success') }}
            </p>
        @endif
        @if ($shop)
            <div class="title">
                {{ $shop->name }}
            </div>
            <div class="shop_edit">
                <a class="shop_edit_a" href="{{ route('shop_representative.edit', $shop->id) }}">
                    店舗情報変更
                </a>
            </div>
        @else
            <p>No shop information available.</p>
        @endif
            <div class="reservation_list">
                <a class="reservation_list_a" href="{{ route('shop_representative.reservations_list') }}">
                    予約一覧
                </a>
            </div>
    </div>
</div>
@endsection
