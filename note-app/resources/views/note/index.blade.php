<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/note.css')  }}" >
    <title>表示ページ</title>
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    @extends('layouts.app')

    @section('content')
    <div class="note_box">

        <button><a href="{{ route('notes.create') }}">新規作成</a></button>

        <h2>ノート一覧</h2>

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