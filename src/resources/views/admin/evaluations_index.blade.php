@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/evaluations_index.css') }}">
@endsection

@section('content')
<div class="evaluations">
    <div class="evaluations_inner">
        <h1 class="evaluations_title">
            口コミ管理
        </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ユーザー</th>
                    <th>コメント</th>
                    <th>星評価</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluations as $evaluation)
                    <tr>
                        <td>{{ $evaluation->id }}</td>
                        <td>{{ $evaluation->user->name }}</td>
                        <td>{{ $evaluation->comment }}</td>
                        <td>{{ $evaluation->stars }}</td>
                        <td>
                            <form action="{{ route('admin.evaluations-destroy', $evaluation->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="dashboard_back_button">
            <a class="dashboard_back_button_link" href="{{ route('admin.dashboard')}}">
                戻る
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
</div>

@endsection
