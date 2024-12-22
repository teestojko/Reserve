@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Representative/reservation_list.css') }}">
@endsection

@section('content')
    <div class="reservation_list">
        <div class="reservation_list_inner">
            <div class="inner_title">
                Reservation List
            </div>
            @php
                $currentDate = \Carbon\Carbon::parse($date ?? now()->toDateString());
                $previousDate = $currentDate->copy()->subDay()->toDateString();
                $nextDate = $currentDate->copy()->addDay()->toDateString();
            @endphp
            <div class="inner_date_navigation">
                <form class="inner_date_navigation_form" action="{{ route('shop_representative.attendance_date', ['date' => $previousDate]) }}" method="get">
                    <button class="submit" type="submit">
                        &lt;
                    </button>
                </form>
                <p class="inner_date">
                    {{ $currentDate->toDateString() }}
                </p>
                <form class="inner_date_navigation_form" action="{{ route('shop_representative.attendance_date', ['date' => $nextDate]) }}" method="get">
                    <button class="submit" type="submit">
                        &gt;
                    </button>
                </form>
            </div>
            @if ($reservations->isEmpty())
                <p class="error_title">
                    予約情報がありません
                </p>
            @else
                <table class="inner_table">
                    <tr class="inner_table_title">
                        <th class="inner_table_name">
                            お名前
                        </th>
                        <th class="inner_table_date">
                            日付
                        </th>
                        <th class="inner_table_time">
                            時間
                        </th>
                        <th class="inner_table_number">
                            人数
                        </th>
                    </tr>
                    @foreach ($reservations as $reservation)
                        <tr class="inner_table_detail">
                            <td class="inner_table_name">
                                {{ $reservation->user->name }}
                            </td>
                            <td class="inner_table_date">
                                {{ $reservation->reservation_date }}
                            </td>
                            <td class="inner_table_time">
                                {{ $reservation->reservation_time }}
                            </td>
                            <td class="inner_table_number">
                                {{ $reservation->number_of_people }}名
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $reservations->links('vendor.pagination.bootstrap-4') }}
            @endif
            <div class="reservation_list_back_button">
                <a class="reservation_list_back_button_button" href="{{ route('shop_representative.dashboard')}}">
                    戻る
                </a>
            </div>
        </div>
    </div>
@endsection
