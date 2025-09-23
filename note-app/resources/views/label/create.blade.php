<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/label.css')  }}" >
    <title>【ラベル】作成</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<header>
    <h1><a href="{{ route('note') }}">CodeNote</a></h1>
</header>

<div class="left_box">
    <form action="{{ route('labels.store') }}" method="POST">
        @csrf
        <label for="name">ラベル名</label><br>
        <input type="text" name="name" id="name" required><br><br>

        <div class="color-row">
            <label>カラー</label>
            <input type="color" class="color_box" name="color" value="{{ $label->color ?? '#cccccc' }}">
            <button type="submit">追加</button>
        </div>
    </form>

    <div class="label-filters">
        <h2>ラベル一覧</h2>
        <form method="GET" action="{{ route('labels.index') }}">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="ラベル名で検索">
            <button type="submit">検索</button>
        </form>
    </div>
    <ul class="label-list">
        @foreach($labels as $label)
        <li class="label-item">
            <span class="label-name">{{ $label->name }}</span>
            <span class="label_color" style="--label-color: {{ $label->color ?? '#cccccc' }};"></span>
            <span class="label-date">
                （登録日: {{ $label->formatted_created_at ?? '' }}）
            </span>
            <div>
                <a class="edit" href="{{ route('labels.edit', ['label' => $label->id]) }}">編集</a>
                <form action="{{ route('labels.destroy', ['label' => $label->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="delete" type="submit" onclick="return confirm('消去しますか?')">消去</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
</body>
</html>