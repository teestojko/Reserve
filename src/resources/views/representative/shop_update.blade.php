@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Representative/shop_update.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="shop_update">
        <div class="shop_update_inner">
            <div class="inner_title">
                店舗情報変更
            </div>
            @if (session('success'))
                <p>
                    {{ session('success') }}
                </p>
            @endif
            <form class="shop_update_form" method="POST" action="{{ route('shop_representative.update', $shop->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="shop_update_content">
                    <div class="image_path_title">
                        画像
                    </div>
                    <label class="image_path_label" for="image_path">
                        画像を選択
                    </label>
                    <input type="file" name="image_path" id="image_path">
                    <div id="file_name">
                        選択ファイル名
                    </div>
                </div>
                @error('image_path')
                    <div class="alert_danger_comment">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_update_content">
                    <div class="content_label">
                        <label for="label">
                            ショップ名
                        </label>
                    </div>
                    <input type="text" name="name" id="name" value="{{ $shop->name }}">
                </div>
                @error('name')
                    <div class="alert_danger_comment2">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_update_content">
                    <div class="content_label">
                        <label for="label">
                            エリア
                        </label>
                    </div>
                    <select name="prefecture_id" id="prefecture">
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ $shop->prefecture_id == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('prefecture_id')
                    <div class="alert_danger_comment">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_update_content">
                    <div class="content_label">
                        <label for="label">
                            ジャンル
                        </label>
                    </div>
                    <select name="genre_id" id="genre">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('genre_id')
                    <div class="alert_danger_comment">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_update_content2">
                    <div class="content_label">
                        <label class="label" for="detail">
                            詳細
                        </label>
                    </div>
                    <textarea name="detail" id="detail">{{ $shop->detail }}</textarea>
                </div>
                @error('detail')
                    <div class="alert_danger_comment5">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_update_button">
                    <button class="shop_update_button_button" type="submit">
                        更新する
                    </button>
                </div>
            </form>
            <div class="shop_update_back_button">
                <a class="shop_update_back_button_link" href="{{ route('shop_representative.dashboard')}}">
                    戻る
                </a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('image_path').addEventListener('change', function(){
            const fileName = this.files[0].name;
            document.getElementById('file_name').textContent = fileName;
        });
    </script>
@endsection
