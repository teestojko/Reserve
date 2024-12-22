@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Representative/shop_create.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="shop_create">
        <div class="shop_create_inner">
            <div class="inner_title">
                店舗作成画面
            </div>
            @if (session('success'))
                <p>
                    {{ session('success') }}
                </p>
            @endif
            <form class="shop_create_form" action="{{ route('shop_representative.shop_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="shop_create_content">
                    <div class="content_title">
                        画像
                    </div>
                    <label class="image_path_label" for="image_path" >
                        画像を選択
                    </label>
                    <input type="file" name="image_path" id="image_path">
                    <div id="file_name">
                        選択ファイル名
                    </div>
                </div>
                @error('image_path')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_create_content">
                    <div class="content_title">
                        ショップ名
                    </div>
                    <label class="name_label" for="name"></label>
                    <input type="text" name="name" id="name">
                </div>
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_create_content">
                    <div class="content_title">
                        エリア
                    </div>
                    <label class="prefecture_label" for="prefecture"></label>
                    <select name="prefecture_id" id="prefecture">
                        <option value="">
                            選択してください
                        </option>
                        @foreach($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('prefecture_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_create_content">
                    <div class="content_title">
                        ジャンル
                    </div>
                    <label class="genre_label" for="genre"></label>
                    <select name="genre_id" id="genre">
                        <option value="">
                            選択してください
                        </option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('genre_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_create_content2">
                    <div class="content_title2">
                        詳細
                    </div>
                    <label class="detail_label" for="detail"></label>
                    <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
                </div>
                @error('detail')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="shop_create_button">
                    <button class="shop_create_button_button" type="submit">
                        店舗を作成
                    </button>
                </div>
            </form>
            <div class="shop_create_back_button">
                <a class="shop_create_back_button_link" href="{{ route('shop_representative.dashboard')}}">
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
