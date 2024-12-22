@php
    $today = now()->format('Y-m-d');
    $currentTime = now()->format('H:i');
@endphp
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection

@section('content')
    <div class="edit">
        <div class="edit_title">
            予約編集
        </div>
        <form class="edit_form" action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form_content">
                <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                <label for="reservation_date"></label>
                <input class="reservation_date_input" type="date" name="reservation_date" min="{{ $today }}">
            </div>
            <div class="form_content">
                <label for="reservation_time"></label>
                <select name="reservation_time" class="reservation_time_select">
                    <option value="">--時間を選択--</option>
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
            </div>
            <div class="form_content">
                <label for="number_of_people"></label>
                <input class="number_of_people_input" type="number" name="number_of_people" min="1" placeholder="人数">
            </div>
            <button type="submit" class="edit_button">
                更新
            </button>
            @if (session('success'))
                <p class="success_message">
                    {{ session('success') }}
                </p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="error_message">
                                {{ $error }}
                            </p>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        <a class="return_my_page" href="/my_page/{shop}">
            マイページへ戻る
        </a>
    </div>
@endsection
