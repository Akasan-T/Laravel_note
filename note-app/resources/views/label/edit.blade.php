<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
        <link rel="stylesheet" href="{{ asset('/css/edit.css') }}">
    <title>【CodeNote】ラベル編集</title>
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    <form method="POST" action="{{ route('labels.update', $label->id) }}">
        @csrf
        @method('PUT')
        <label for="name">ラベル名</label>
        <input type="text" id="name" name="name" value="{{ $label->name }}">
        <button type="submit">更新</button>
    </form>

    <a href="{{ route('label.create') }}"></a>
</body>
</html>