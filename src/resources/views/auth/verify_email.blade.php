<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/register_thanks.css') }}">
    </head>
    <body>
        <div class="thanks_main">
            <div class="thanks_title">
                Rese
            </div>
            <div class="thanks_content">
                <div class="thanks_message">
                    会員登録ありがとうございます
                </div>
                <button class="login_submit" type="submit">
                    ログインする
                </button>
                <small class="login_message">
                    送られてきたメールからログインして下さい
                </small>
            </div>
            <div class="thanks_retry">
                <div class="comment">
                    メールを受信していない方は下記のリンクで再送信をお願いします。
                </div>
                <form class="form" method="POST" action="{{ route('verification.send') }}">
                @csrf
                    <button class="submit" type="submit">
                        メールの再送信
                    </button>
                </form>
            </div>
            <div class="thanks_message2">
                @if (session('message'))
                    <div>
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>


