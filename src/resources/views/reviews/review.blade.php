@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection

@section('content')
    <div class="review">
        <div class="review_inner">
            <div class="inner_title">
                レビューを投稿
            </div>
            <form class="review_form" action="{{ route('reviews.store', $shop->id) }}" method="POST">
            @csrf
                <div class="form_inner">
                    <div class="form_inner_title">
                        <label class="form_inner_label" for="comment">
                            レビュー内容
                        </label>
                    </div>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div class="form_inner2">
                    <div class="form_inner_title">
                        <label class="form_inner_label" for="stars">
                            評価
                        </label>
                    </div>
                    <select id="select" name="stars">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="review_button">
                    <div class="review_button_inner">
                        <button type="submit" class="review_button_inner_submit">
                            投稿する
                        </button>
                    </div>
                    <div class="review_confirm">
                        <a href="{{ route('reviews.index', ['shop' => $shop->id]) }}" class="review_confirm_link">
                            レビューを確認する
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="btn_section">
            <div class="review_back_button">
                <a class="review_back_button_link" href="{{ route('shops.show', ['shop' => $shop->id]) }}">
                    戻る
                </a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert_success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert_danger">
                <ul class="error_list">
                    @foreach ($errors->all() as $error)
                        <li class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
