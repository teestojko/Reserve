@extends('Layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/Evaluation/evaluation.css') }}">
@endsection

@section('content')
    <div class="evaluation">
        <div class="evaluation_inner">
            <div class="evaluation_shop">
                <div class="evaluation_shop_inner">
                    <h1 class="evaluation_shop_title">
                        今回のご利用はいかがでしたか？
                    </h1>
                    <div class="shop_list">
                        @foreach([$shop] as $shop)
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
                </div>
            </div>
            <div class="evaluation_section">
                <div class="section_title">
                    体験を評価してください
                </div>
                <div class="evaluation_section_inner">
                    <form class="evaluation_form" action="{{ route('evaluations-store', $shop->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form_star">
                            <div class="form_inner_title">
                                <label class="form_inner_label" for="stars">
                                </label>
                            </div>
                            <div id="app"></div>
                            @error('stars')
                                <div class="alert-danger_star">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form_comment">
                            <div class="form_comment_title">
                                <label class="form_inner_label" for="comment">
                                    口コミを投稿
                                </label>
                            </div>
                            <textarea id="comment" name="comment" placeholder="カジュアルな夜のお出かけにおすすめのスポット"></textarea>
                            <div class="character-count" id="characterCount">
                                0/400 最大文字数
                            </div>
                        </div>
                            @error('comment')
                                <div class="alert_danger_comment">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="form_img">
                            <div class="form_img_title">
                                画像を追加
                            </div>
                            <label class="form_img_label" for="image_path">
                                クリックして画像を追加<br>またはドロップアンドドロップ
                            </label>
                            <input type="file" id="image_path" name="image_path" accept="image_path/*">
                        </div>
                        @error('image_path')
                            <div class="alert_danger_image">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="evaluation_button">
                            <div class="evaluation_button_inner">
                                <button type="submit" class="evaluation_button_inner_submit">
                                    口コミを投稿
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @if(session('success'))
                    <div class="alert_success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->has('custom_error'))
                    <div class="alert_danger">
                        {{ $errors->first('custom_error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.SHOP_ID = {{ $shop->id }};

        function updateCharacterCount() {
            const comment = document.getElementById('comment');
            const characterCount = document.getElementById('characterCount');
            const currentLength = comment.value.length;
            characterCount.textContent = `${currentLength}/400 最大文字数`;

            if (currentLength > 400) {
                characterCount.style.color = 'red';
            } else {
                characterCount.style.color = '';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const commentField = document.getElementById('comment');
            const dropArea = document.querySelector('.form_img_label');
            const fileInput = document.getElementById('image_path');

            if (commentField) {
                commentField.addEventListener('input', updateCharacterCount);
            }

            if (dropArea) {
                dropArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropArea.classList.add('dragover');
                });

                dropArea.addEventListener('dragleave', () => {
                    dropArea.classList.remove('dragover');
                });

                dropArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropArea.classList.remove('dragover');

                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files;

                        dropArea.textContent = files[0].name;
                    }
                });
            }
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

