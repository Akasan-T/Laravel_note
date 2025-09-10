<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録</h1>
    <form action="{{ route('sign_up.store') }}" method="POST">
        @csrf
        <label>名前</label>
        <input type="text" name="name">

        <label>メールアドレス</label>
        <input type="email" name="email">

        <label>パスワード</label>
        <input type="password" name="password">

        <label>パスワード確認</label>
        <input type="password" name="passwordConfirmation">

        <button type="submit">サインアップ</button>
    </form>

    @if (!empty($error))
        <p>{{ $error }}</p>
    @endif

</body>
</html>