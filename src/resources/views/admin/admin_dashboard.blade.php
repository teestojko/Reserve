@extends('Layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Admin/admin_dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="admin_dashboard">
        <div class="admin_dashboard_title">
            Admin Dashboard
        </div>
        <div class="admin_dashboard_create_owner">
            <a class="create_owner_link" href="{{ route('admin.edit_create') }}">
                店舗代表者作成
            </a>
        </div>
        <div class="admin_dashboard_email">
            <a class="email_link" href="{{ route('admin.send_email') }}">
                メール送信画面
            </a>
        </div>
    </div>
@endsection
