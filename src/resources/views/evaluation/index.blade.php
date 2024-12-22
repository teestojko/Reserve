@extends('Layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/Evaluation/index.css') }}">
@endsection

@section('content')
    <div class="evaluation_page">
        <div class="shop_back_btn">
            <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="shop_back_btn_link">
                戻る
            </a>
        </div>
        <div class="shop_header">
            <h1>{{ $shop->name }}の口コミ一覧</h1>
        </div>
        @if($evaluations->isEmpty())
            <p class="no_evaluation">まだ口コミはありません。</p>
        @else
            <div class="evaluations_list">
                @foreach($evaluations as $evaluation)
                    <div class="evaluation_item">
                        <div class="evaluation_user">
                            <p>{{ $evaluation->user->name }}</p>
                        </div>
                        <div class="evaluation_stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $evaluation->stars ? 'filled' : '' }}">&#9733;</span>
                            @endfor
                        </div>
                        <p class="evaluation_comment">{{ $evaluation->comment }}</p>
                        @if($evaluation->image_path)
                            <img src="{{ asset(str_replace('public/', 'storage/', $evaluation->image_path)) }}" alt="評価画像" class="evaluation_image">
                        @else
                            <p class="no_image_text">画像はありません</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
