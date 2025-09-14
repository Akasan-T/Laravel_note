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
    <div class="container mx-auto p-4">
        <h1 class="text-2x1 font-bold mb-4">ノート一覧</h1>

        <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">新規作成</a>

        @if($notes->count())
            <ul>
                @foreach($notes as $note)
                    <li class="border p-2 mb-2 rounded hover:bg-gray-50">
                        <a href="{{ route('route('notes.show', $note->id) }}" class="text_blue-600 font-medium">
                            {{ $note->title }}
                        </a>
                        <span class="text-gray-500 text-sm">({{ $note->created_at->format('y-m-d') }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>ノートはまだありません。</p>
        @endif
    </div>
    @endsection
</body>
</html>