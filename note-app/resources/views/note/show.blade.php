<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/show.css') }}">
    <title>{{ $note->title }}</title>
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    <div class="box">
        <button><a href="{{ route('notes.index') }}">戻る</a></button>
        <button><a href="{{ route('notes.edit', $note->id) }}">編集</a></button>
        <div class="contents_box">
            {!! $htmlContent !!}
        </div>
        <p><small>作成日: {{ $note->created_at->format('Y-m-d') }}</small></p>
    </div>
</body>
</html>