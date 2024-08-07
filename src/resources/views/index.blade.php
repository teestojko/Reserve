@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <form class="search_form" id="filterForm" action="{{ route('shops.filter') }}" method="GET">
    <div class="search_container">
        <div class="search1">
            <label class="search_label" for="prefecture_id"></label>
            <select class="search_select" name="prefecture_id" id="prefecture_id">
                <option value="" class="placeholder">All area</option>
                @foreach($prefectures as $prefecture)
                    <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                @endforeach
            </select>
            <i class="fas fa-caret-down" style="color: #c7c7c7; position: absolute; top: 35%; left: 14%;"></i>
        </div>
        <div class="search2">
            <label class="search_label" for="genre_id"></label>
            <select class="search_select2" name="genre_id" id="genre_id">
                <option value="" class="placeholder">All genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
            <i class="fas fa-caret-down " style="color: #c7c7c7; position: absolute; top: 35%; left: 31%;" ></i>
        </div>
        <div class="search3">
            <label class="search_label" for="shop_name"></label>
            <button type="submit" class="submit3">
                <i class="fas fa-search search_icon"></i>
            </button>
            <input type="text" name="shop_name" id="shop_name" class="search_input" placeholder="Search ...">
        </div>
    </div>
</form>


    <div class="shop_list">
        @foreach($shops as $shop)
            <div class="shop_item">
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
                        <div class="shop_primary_favorite">
                            <p class="shop_primary">
                                <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="btn-primary">詳しく見る</a>
                            </p>
                            <form class="shop_form" action="{{ $shop->isFavorited() ? route('favorites.toggle.remove', ['shop' => $shop->id]) : route('favorites.toggle.add', ['shop' => $shop->id]) }}" method="POST">
                            @csrf
                                @if ($shop->isFavorited())
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
    </div>
    {{-- @section('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filterForm');
            const selects = filterForm.querySelectorAll('select');
            selects.forEach(select => {
                select.addEventListener('change', function () {
                    filterForm.submit();
                });
            });
        });
        </script>
    @endsection --}}
@endsection

