@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/send_email.css') }}">
@endsection

@section('content')
    <h1>全てのユーザーにメール送信</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.send_email') }}" method="POST">
        @csrf
        <div>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" required>
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" required></textarea>
        </div>
        <div>
            <button type="submit">Send Email</button>
        </div>
    </form>
@endsection
