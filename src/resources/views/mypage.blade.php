@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="mypage_top">
        <div class="user_name">
            @if (Auth::check())
        <p class='message'>
            {{ Auth::user()->name }} さん
        </p>
        @endif
        </div>
        <div class="user_mypage_contents">
            <div class="user_reservation">
                <div class="user_mypage_main">予約状況</div>

            @if ($reservations->isEmpty())
                <p>予約情報はありません。</p>
            @else
                <ul>
                    @foreach ($reservations as $reservation)
                        <li>
                            <img src="{{ Storage::url('clock.jpeg') }}" alt="Clock Image">
                            <p>予約{{ $reservation->id }}</p>
                            <p>Shop {{ $reservation->shop->name }}</p>
                            <p>Date {{ $reservation->reservation_date }}</p>
                            <p>Time {{ $reservation->reservation_time }}</p>
                            <p>Number {{ $reservation->number_of_people }}人</p>
                        </li>
                    @endforeach
                </ul>
            @endif
            </div>
            <div class="user_mypage">
                <div class="user_mypage_main">お気に入り店舗</div>
                @if ($favorites->count() > 0)
                    <ul class="user_mypage_ul">
                        @foreach ($favorites as $favorite)
                        <div class="user_mypage_item">
                            <img class="user_mypage_img" src="{{ asset($favorite->image_path) }}" alt="{{ $favorite->name }}">
                            <div class="user_mypage_detail">
                            <div class="user_mypage_name">
                                {{ $favorite->name }}
                            </div>
                                <div class="user_mypage_prefecture_genre">
                                    <p class="user_mypage_prefecture">
                                    <span>
                                        #
                                    </span>
                                        {{ $favorite->prefecture->name }}
                                    </p >
                                    <p class="user_mypage_genre">
                                    <span>
                                        #
                                    </span>
                                        {{ $favorite->genre->name }}
                                    </p>
                                </div>
                            <div class="user_mypage_primary_favorite">
                                <p class="user_mypage_primary">
                                    <a href="{{ route('shops.show', ['shop' => $favorite->id]) }}" class="btn-primary">詳しく見る</a>
                                </p>
                                <form class="user_mypage_form" action="{{ $favorite->isFavorited() ? route('favorites.toggle.remove', ['shop' => $favorite->id]) : route('favorites.toggle.add', ['shop' => $favorite->id]) }}" method="POST">
                                @csrf
                                    @if ($favorite->isFavorited())
                                        @method('DELETE')
                                        <button type="submit" class="submit">
                                            <i class="fas fa-heart" style="color: red; background: none; border: none; font-size: 24px;"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="submit2">
                                            <i class="far fa-heart" style="color: #c7c7c7;; background: none; border: none; font-size: 24px;"></i>
                                        </button>
                                    @endif
                                </form>
                            </div>
                    </div>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>お気に入り店舗はありません。</p>
                @endif
            </div>
        </div>
    </div>
@endsection
