@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <form class="sort_form" id="sortForm" action="{{ route('shops_filter') }}" method="GET">
        <!-- 現在の検索条件を保持 -->
        <input type="hidden" name="prefecture_id" value="{{ request('prefecture_id') }}">
        <input type="hidden" name="genre_id" value="{{ request('genre_id') }}">
        <input type="hidden" name="shop_name" value="{{ request('shop_name') }}">
        <!-- 並び替えセレクトボックス -->
        <div class="sort_area">
            <label class="sort_label" for="sort"></label>
            <select name="sort" id="sort" onchange="document.getElementById('sortForm').submit();">
                <option value="" disabled {{ request('sort') ? '' : 'selected' }}>並び替え：評価高/低</option>
                <option value="random" {{ request('sort') == 'random' ? 'selected' : '' }}>ランダム</option>
                <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>評価の高い順</option>
                <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>評価の低い順</option>
            </select>
        </div>
    </form>

    <form class="search_form" id="filterForm" action="{{ route('shops_filter') }}" method="GET">
        <div class="search_container">
            <div class="search_area">
                <label class="search_label" for="prefecture_id"></label>
                <select class="search_select_area" name="prefecture_id" id="prefecture_id">
                    <option value="" class="placeholder">
                        All area
                    </option>
                    @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}"{{ request('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                            {{ $prefecture->name }}
                        </option>
                    @endforeach
                </select>
                <i class="fas fa-caret-down"></i>
            </div>

            <div class="search_genre">
                <label class="search_label" for="genre_id"></label>
                <select class="search_select_genre" name="genre_id" id="genre_id">
                    <option value="" class="placeholder">
                        All genre
                    </option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                <i class="fas fa-caret-down"></i>
            </div>

            <div class="search_shop_name">
                <label class="search_label" for="shop_name"></label>
                    <button type="submit" class="submit_shop_name">
                        <i class="fas fa-search search_icon"></i>
                    </button>
                <input type="text" name="shop_name" id="shop_name" class="search_input" placeholder="Search ...">
            </div>
        </div>
    </form>

    <div class="shop_list">
        @foreach($shops as $shop)
            <div class="shop_content">
                <img class="shop_img" src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
                <div class="shop_detail">
                    <div class="shop_name">
                        {{ $shop->name }}
                    </div>
                    <div class="shop_prefecture_genre">
                        <p class="shop_prefecture">
                            <span>
                                #
                            </span>
                            {{ $shop->prefecture->name }}
                        </p >
                        <p class="shop_genre">
                            <span>
                                #
                            </span>
                            {{ $shop->genre->name }}
                        </p>
                    </div>
                    <div class="shop_form">
                        <p class="shop_primary">
                            <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="detail_button">詳しく見る</a>
                        </p>
                        <form class="shop_favorite_button" action="{{ $shop->isFavorited() ? route('favorites.toggle.remove', ['shop' => $shop->id]) : route('favorites.toggle.add', ['shop' => $shop->id]) }}" method="POST">
                        @csrf
                            @if ($shop->isFavorited())
                            @method('DELETE')
                                <button type="submit" class="submit_favorite">
                                    <i class="fas fa-heart"></i>
                                </button>
                            @else
                                <button type="submit" class="submit_not_favorite">
                                    <i class="far fa-heart"></i>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @section('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filterForm');
            const selects = filterForm.querySelectorAll('select');
            selects.forEach(select => {
                select.addEventListener('change', function () {
                    filterForm.submit();
                });
            });
            const sortForm = document.getElementById('sortForm');
            const sortSelect = document.getElementById('sort');
            sortSelect.addEventListener('change', function () {
                sortForm.submit();
            });
        });
        </script>
    @endsection
@endsection

