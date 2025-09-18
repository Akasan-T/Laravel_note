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
        <button type="submit">追加</button>
    </form>

    <h2>ラベル一覧</h2>
    <ul>
        @foreach($labels as $label)
        <li>
            {{ $label->name }}
            <span style="color: gray; font-size: 0.9em;">
                （登録日: {{ $label->created_at->format('Y-m-d H:i') }}）
            </span>
            <a class="edit" href="{{ route('labels.edit',$label->id) }}">編集</a>
            <form action="{{ route('labels.destroy', $label->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="delete" type="submit" onclick="return confirm('消去しますか?')">消去</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
@endsection
</body>
</html>