@extends('layouts.app')

@section('content')
    <div class="check_in">
        <div class="check_in_inner">
            予約確認
        </div>
        <p class="check_in_content">
            予約ID: {{ $reservation->id }}
        </p>
        <p class="check_in_content">
            お名前: {{ $reservation->customer_name }}
        </p>
        <p class="check_in_content">
            予約日時: {{ $reservation->reservation_date }}
        </p>
        <form class="check_in_form" action="{{ route('confirm_check_in', $reservation->id) }}" method="POST">
        @csrf
            <button type="submit" class="check_in_button">
                予約確認済み
            </button>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection
