@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/Evaluation/edit.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
<div class="evaluation_edit">
    <div class="container">
        <h2 class="edit_title">評価の編集</h2>
        <form action="{{ route('evaluations-update', $evaluation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="stars">星の数：</label>
                <select name="stars" class="form-control">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $evaluation->stars == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="comment">コメント：</label>
                <textarea name="comment" class="form-control">{{ old('comment', $evaluation->comment) }}</textarea>
            </div>
            <div class="image_content">
                <div class="image_section">
                    @if($evaluation->image_path)
                        <img src="{{ asset('storage/' . $evaluation->image_path) }}" alt="評価画像" class="evaluation_image">
                    @endif
                </div>
                <div class="shop_create_file">
                    <div class="shop_create_content">
                        <label class="image_path_label" for="image_path" >
                            画像を選択
                        </label>
                        <input type="file" name="image_path" id="image_path">
                    </div>
                </div>
            </div>
            <div id="file_name">
                選択ファイル名
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
    <script>
        document.getElementById('image_path').addEventListener('change', function(){
            const fileName = this.files[0].name;
            document.getElementById('file_name').textContent = fileName;
        });
    </script>
@endsection
