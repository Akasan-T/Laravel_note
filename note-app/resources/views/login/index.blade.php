<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/login.css')  }}">

    <title>【CodeNote】ログイン</title>
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    <h1>ログイン</h1>
    <form action="{{ route("login.store") }}" method="POST" >
        @csrf
        <label for="email">メールアドレス</label>
        <input class="mail" type="email" name="email">

        <label for="password">パスワード</label>
        <input class=pas type="password" name="password">

        <button type="submit">ログイン</button>
        <a href="{{ route("sign_up") }}">新規登録へ</a>
    </form>

    @if (!empty($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html>