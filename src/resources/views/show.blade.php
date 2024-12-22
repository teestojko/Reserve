@php
    $today = now()->format('Y-m-d');
    $currentTime = now()->format('H:i');
@endphp
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="shop">
        <div class="shop_all">
            <div class="shop_detail_page">
            @if(!$userEvaluation)
                <div class="shop_name_top">
                    <a href="{{ route('user_my_page') }}" class="btn-secondary">
                        &lt;
                    </a>
                    <div class="shop_name">
                        {{ $shop->name }}
                    </div>
                </div>
                <img class="shop_img" src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
                <div class="shop_detail">
                    <div class="show_prefecture_genre">
                        <p class="show_prefecture">
                            <span>
                                #
                            </span>
                            {{ $shop->prefecture->name }}
                        </p>
                        <p class="show_genre">
                            <span>
                                #
                            </span>
                            {{ $shop->genre->name }}
                        </p>
                    </div>
                    <p>
                        {{ $shop->detail }}
                    </p>
                    <div class="evaluation_store_button">
                        <a href="{{ route('shop-evaluation', ['shop' => $shop->id]) }}" class="btn-primary3">
                            口コミを投稿する
                        </a>
                    </div>
                </div>
            @else
            <div class="evaluation_content">
                <div class="evaluation_section">
                    <img class="evaluation_img" src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
                    <div class="evaluation_shop_detail">
                        <div class="evaluation_show_prefecture_genre">
                            <p class="evaluation_show_prefecture">
                                <span>
                                    #
                                </span>
                                {{ $shop->prefecture->name }}
                            </p>
                            <p class="evaluation_show_genre">
                                <span>
                                    #
                                </span>
                                {{ $shop->genre->name }}
                            </p>
                        </div>
                            <p class="evaluation_detail">
                                {{ $shop->detail }}
                            </p>
                    </div>
                    <div class="evaluation_button">
                        <a href="{{ route('shop-all-evaluations', ['shop' => $shop->id]) }}" class="btn-primary4">
                            全ての口コミ情報
                        </a>
                    </div>
                </div>
                <div class="edit_delete_btn">
                    @if($userEvaluation)
                        <a href="{{ route('evaluations.edit', $userEvaluation->id) }}" class="edit_btn_link">
                            口コミを編集
                        </a>
                    @endif
                    <form action="{{ route('evaluations-destroy', $userEvaluation->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete_btn">口コミを削除</button>
                    </form>
                </div>
                <div class="user_evaluation">
                    <div class="table_item">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= $userEvaluation->stars ? 'filled' : '' }}">&#9733;</span>
                        @endfor
                    </div>
                    <p class="evaluation_comment"> {{ $userEvaluation->comment }}</p>
                </div>
            </div>
            @endif
            </div>
            <div class="reservation_form">
                <div class="reservation_main">
                <div class="reservation_title">
                    予約
                </div>
                <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                    <div class="input_form">
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <div class="reserve_form-group">
                            <label for="reservation_date">
                            </label>
                            <input class="input" type="date" id="reservation_date" name="reservation_date" class="form-control" min="{{ $today }}">
                            @error('reservation_date')
                                <div class="alert alert-danger1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="reserve_form-group">
                            <label for="reservation_time"></label>
                            <select id="reservation_time" name="reservation_time" class="form-control">
                                <option value="">時間を選択</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                                <option value="22:30">22:30</option>
                                <option value="23:00">23:00</option>
                                <option value="23:30">23:30</option>
                            </select>
                            @error('reservation_time')
                                <div class="alert alert-danger2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="reserve_form-group">
                            <label for="number_of_people"></label>
                            <input class="input3" type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" placeholder="人数を選択">
                            @error('number_of_people')
                                <div class="alert alert-danger3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div id="nearest_reservation_section">
                            <div class="reservation_table_main">
                                <table class="reservation_table">
                                    <tr class="reservation_tr">
                                        <td class="reservation_label">
                                            Shop
                                        </td>
                                        <td class="reservation_value">
                                            {{ $shop->name }}
                                        </td>
                                    </tr>
                                    <tr class="reservation_tr">
                                        <td class="reservation_label">
                                            Date
                                        </td>
                                        <td class="reservation_value" id="selected_date"></td>
                                    </tr>
                                    <tr class="reservation_tr">
                                        <td class="reservation_label">
                                            Time
                                        </td>
                                        <td class="reservation_value" id="selected_time"></td>
                                    </tr>
                                    <tr class="reservation_tr">
                                        <td class="reservation_label">
                                            Number
                                        </td>
                                        <td class="reservation_value" id="selected_people"></td>
                                    </tr>
                                </table>
                            </div>
                            @if ($errors->has('error'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('error') }}
                                </div>
                            @endif
                        </div>
                        <script>
                            document.getElementById('reservation_date').addEventListener('change', function() {
                                var selectedDate = this.value;
                                document.getElementById('selected_date').innerText = selectedDate;
                                document.getElementById('nearest_reservation_section').style.display = 'block';
                            });
                            document.getElementById('reservation_time').addEventListener('change', function() {
                                var selectedTime = this.value;
                                document.getElementById('selected_time').innerText = selectedTime;
                                document.getElementById('nearest_reservation_section').style.display = 'block';
                            });
                            document.getElementById('number_of_people').addEventListener('change', function() {
                                var selectedPeople = this.value;
                                document.getElementById('selected_people').innerText = selectedPeople + "人";
                                document.getElementById('nearest_reservation_section').style.display = 'block';
                            });
                        </script>
                    </div>
                    <button type="submit" class="btn-primary">
                        予約する
                    </button>
                </form>
                </div>
            </div>
            <div class="button">
                <a href="{{ route('reviews.review', ['shop' => $shop->id]) }}" class="btn-primary2">
                    レビューを投稿する
                </a>
            </div>
        </div>
    </div>
@endsection
