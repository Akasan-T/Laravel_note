<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
</head>
<body>
    <h1>ログイン</h1>
    <form action="{{ route("login.store") }}" method="POST">
        @csrf
        <label for="email">メールアドレス</label>
        <input type="email" name="email">

        <label for="password">パスワード</label>
        <input type="password" name="password">

        <button type="submit">ログイン</button>
    </form>

    @if (!empty($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html>