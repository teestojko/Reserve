@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Representative/shop_update.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="content">
        <div class="detail">
            <div class="top">
                店舗情報変更
            </div>
            @if (session('success'))
                <p>
                    {{ session('success') }}
                </p>
            @endif
            <form class="shop_update_form" method="POST" action="{{ route('shop_representative.update', $shop->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="column">
                    <div class="image_path_top">
                        Image_Path
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
                <div class="column">
                    <div class="label_content">
                        <label for="label">
                            Name
                        </label>
                    </div>
                    <input type="text" name="name" id="name" value="{{ $shop->name }}">
                </div>
                @error('name')
                    <div class="alert_danger_comment2">
                        {{ $message }}
                    </div>
                @enderror
                <div class="column">
                    <div class="label_content">
                        <label for="label">
                            Prefecture
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
                <div class="column">
                    <div class="label_content">
                        <label for="label">
                            Genre
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
                <div class="column2">
                    <div class="label_content">
                        <label class="label" for="detail">
                            Detail
                        </label>
                    </div>
                    <textarea name="detail" id="detail">{{ $shop->detail }}</textarea>
                </div>
                @error('detail')
                    <div class="alert_danger_comment5">
                        {{ $message }}
                    </div>
                @enderror
                <div class="submit_content">
                    <button class="submit" type="submit">
                        更新する
                    </button>
                </div>
            </form>
            <div class="dashboard_button_content">
                <a class="dashboard_button" href="{{ route('shop_representative.dashboard')}}">
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
