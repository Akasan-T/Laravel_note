<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/note.css')  }}" >
    <title>【CodeNote】一覧</title>
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    @extends('layouts.app')

    @section('content')
    <div class="note_box">

        <button><a href="{{ route('notes.create') }}">新規作成</a></button>
        <button><a href="{{ route('label.create') }}">ラベル作成</a></button>

        <div class="box">            
            <h2>Note一覧</h2>
            
            <div class="filter-box">
                <form method="GET" action="{{ route('notes.index') }}">
                    <label for="label">ラベルで絞り込み:</label>
                    <select name="label" id="label" onchange="this.form.submit()">
                        <option value="">すべて</option>
                        @foreach($labels as $label)
                            <option value="{{ $label->id }}" {{ isset($labelId) && $labelId == $label->id ? 'selected' : '' }}>
                                {{ $label->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="search-box">
                <form method="GET" action="{{ route('notes.index') }}">
                    <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="検索ワードを入力">
                    <button type="submit">検索</button>
                </form>
            </div>
        </div>

        @if($notes->count())
            <ul class="note-list">
                @foreach($notes as $note)
                    <li>
                        <a href="{{ route('notes.show', $note->id) }}" >
                            <span class="note_title">{{ $note->title }}</span>
                            <p class="note-preview">
                                {!! $note->html_preview !!}
                            </p>
                        
                            @foreach($note->labels as $label)
                                <span style="background-color: {{ $label->color ?? '#cccccc' }}; color: #fff; padding: 0.2em 0.5em; border-radius: 4px; margin-right: 0.3em;">
                                    {{ $label->name }}
                                </span>
                            @endforeach

                            <span class="day">({{ $note->created_at->format('y-m-d') }})</span>
                        </a>
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