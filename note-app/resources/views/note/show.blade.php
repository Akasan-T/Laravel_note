<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>{{ $note->title }}</title>
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    <div>
        <button><a href="{{ route('notes.index') }}">戻る</a></button>
        <button><a href="{{ route('notes.index') }}">編集</a></button>
        <div>
            {!! $htmlContent !!}
        </div>
        <p><small>作成日: {{ $note->created_at->format('Y-m-d') }}</small></p>
    </div>
</body>
</html>