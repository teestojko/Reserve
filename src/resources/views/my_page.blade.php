@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="user_name">
        @if (Auth::check())
        <p class='my_page_user_name'>
            {{ Auth::user()->name }} さん
        </p>
        @endif
    </div>
    <div class="my_page">
        <div class="my_page_reservation">
            <div class="reservation_title">
                予約状況
            </div>
            <div class="reservation_inner">
                <div class="reservation_content">
                    @if ($all_reservations->isEmpty())
                        <p class="null_reservation">
                            予約情報はありません。
                        </p>
                    @else
                    @foreach ($all_reservations as $reservation)
                        <div class="reservation_section">
                            <table class="reservation_table">
                                <div class="table_inner">
                                    <i class="fa-regular fa-clock"></i>
                                    <div class="reservation_id">
                                        予約{{ $loop->iteration }}
                                    </div>
                                    <p class="reservation_delete">
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </p>
                                </div>
                                    <tr class="table_content">
                                        <td class="content_title">
                                            Shop
                                        </td>
                                        <td class="table_item">
                                            {{ $reservation->shop->name }}
                                        </td>
                                    </tr>
                                    <tr class="table_content">
                                        <td class="content_title">
                                            Date
                                        </td>
                                        <td class="table_item">
                                            {{ $reservation->reservation_date }}
                                        </td>
                                    </tr>
                                    <tr class="table_content">
                                        <td class="content_title">
                                            Time
                                        </td>
                                        <td class="table_item">
                                            {{ $reservation->reservation_time }}
                                        </td>
                                    </tr>
                                    <tr class="table_content">
                                        <td class="content_title">
                                            Number
                                        </td>
                                        <td class="table_item">
                                            {{ $reservation->number_of_people }}人
                                        </td>
                                    </tr>
                            </table>
                            <div class="reservation_change">
                                <div class="reservation_item">
                                    <a href="{{ route('reservations.edit', $reservation->id) }}">
                                        <i class="fas fa-edit">
                                            予約変更
                                        </i>
                                    </a>
                                </div>
                                <a class="qr_scan" href="{{ route('qr_scanner', $reservation->id) }}">
                                    QR表示
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="my_page_favorite">
            <div class="favorite_title">
                お気に入り店舗
            </div>
            @if ($favorites->isEmpty())
                <p>
                    お気に入り店舗はありません。
                </p>
            @else
                <ul class="favorite_inner">
                    @foreach ($favorites as $favorite)
                    <div class="favorite_content">
                        <img class="favorite_img" src="{{ asset($favorite->image_path) }}" alt="{{ $favorite->name }}">
                        <div class="favorite_section">
                            <div class="favorite_name">
                                {{ $favorite->name }}
                            </div>
                            <div class="favorite_prefecture_genre">
                                <p class="favorite_prefecture">
                                    <span>
                                        #
                                    </span>
                                    {{ $favorite->prefecture->name }}
                                </p >
                                <p class="favorite_genre">
                                    <span>
                                        #
                                    </span>
                                    {{ $favorite->genre->name }}
                                </p>
                            </div>
                            <div class="favorite_primary_favorite">
                                <p class="favorite_primary">
                                    <a href="{{ route('shops.show', ['shop' => $favorite->id]) }}" class="btn-primary">
                                        詳しく見る
                                    </a>
                                </p>
                                <form class="favorite_form" action="{{ $favorite->isFavorited() ? route('favorites.toggle.remove', ['shop' => $favorite->id]) : route('favorites.toggle.add', ['shop' => $favorite->id]) }}" method="POST">
                                @csrf
                                    @if ($favorite->isFavorited())
                                        @method('DELETE')
                                        <button type="submit" class="submit">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="submit2">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
