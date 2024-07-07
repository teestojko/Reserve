@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="shop_list">
        @foreach($shops as $shop)
            <div class="shop_item">
                <img src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
                <div class="shop_detail">
                    {{ $shop->name }}
                        <div class="shop_content">
                            <p>
                                {{ $shop->prefecture }}
                            </p>
                            <p>
                                {{ $shop->genre }}
                            </p>
                            <p>
                                {{-- <i class="fas fa-heart" style="color: red;"></i> --}}

                                {{-- < action="{{ route('favorites.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                <input type="submit" value="❤" class="fas fa-heart" style="color: red; background: none; border: none; font-size: 24px;"> --}}

                                <form action="{{ route('favorites.toggle', ['shop' => $shop->id]) }}" method="POST">
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
                            </p>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
