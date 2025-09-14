<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>表示ページ</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div>
        <h1>ノート一覧</h1>

        <a href="{{ route('notes.create') }}">新規作成</a>

        @if($notes->count())
            <ul>
                @foreach($notes as $note)
                    <li>
                        <a href="{{ route('notes.show', $note->id) }}" >
                            {{ $note->title }}
                        </a>
                        <span>({{ $note->created_at->format('y-m-d') }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>ノートはまだありません。</p>
        @endif
    </div>
</body>
    @endsection
</html>