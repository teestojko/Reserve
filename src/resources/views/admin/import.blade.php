@extends('Layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/Admin/import.css') }}">
@endsection

@section('content')
<div class="csv_import_container">
    <h1 class="csv_import_title">CSVデータインポート</h1>
    <p class="csv_import_description">
        下記のフォームからCSVファイルを選択し、「インポート」ボタンを押してください。
    </p>

    <form class="csv_form" action="{{ route('admin.import-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="csv_input_container">
            <label for="csv_file" class="csv_input_label">CSVファイルを選択</label>
            <input id="csv_file" class="csv_input" type="file" name="csv_file" accept=".csv">
        </div>
        <button class="csv_btn" type="submit">インポート</button>
    </form>

    <div class="csv_messages">
        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>エラーが発生しました：</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error_message">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <p class="success_message">{{ session('success') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
