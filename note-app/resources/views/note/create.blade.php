<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【ノート】新規作成</title>
    <!-- CodeMirror CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/idea.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/create.css')  }}" >
</head>
<body>
    <header>
        <h1><a href="{{ route('note') }}">CodeNote</a></h1>
    </header>
    <form method="POST" action="{{ route('notes.store') }}">
        <div class="editor-container">
            <!-- Markdown入力側 -->
            <div class="editor">
                @csrf
                <label for="title">タイトル</label><br>
                <input type="text" id="title" name="title"><br>
                <label for="editor">内容 (Markdown)</label>
                <textarea id="editor" name="content"></textarea>
                <br>
                <button type="submit">保存</button>
            </div>

            <!-- プレビュー側 -->
            <div class="preview-container">
                <label for="labels">ラベル</label><br>
                <div class="label_box">
                    @foreach($labels as $label)
                        <label>
                            <input type="checkbox" name="labels[]" value="{{ $label->id }}"
                                {{ isset($note) && $note->labels->contains($label->id) ? 'checked' : '' }}>
                            {{ $label->name }}
                        </label><br>
                    @endforeach
                </div>
                <label for="preview">プレビュー</label>
                <div id="preview"></div>
                <button><a href="{{ route('note') }}">戻る</a></button>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/markdown/markdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            mode: "markdown",
            lineNumbers: true,
            theme: "idea",
            lineWrapping: true,
            autofocus: true
        });

        var preview = document.getElementById("preview");

        function updatePreview() {
            preview.innerHTML = marked.parse(editor.getValue());
        }
        editor.on("change", updatePreview);
        updatePreview();

        // フラグで無限ループ防止
        var isSyncingEditor = false;
        var isSyncingPreview = false;

        // エディタ → プレビュー
        editor.getScrollerElement().addEventListener('scroll', function() {
            if (isSyncingPreview) return;
            isSyncingEditor = true;
            var scrollInfo = editor.getScrollInfo();
            var scrollRatio = scrollInfo.top / (scrollInfo.height - scrollInfo.clientHeight);
            preview.scrollTop = scrollRatio * (preview.scrollHeight - preview.clientHeight);
            isSyncingEditor = false;
        });

        // プレビュー → エディタ
        preview.addEventListener('scroll', function() {
            if (isSyncingEditor) return;
            isSyncingPreview = true;
            var scrollRatio = preview.scrollTop / (preview.scrollHeight - preview.clientHeight);
            var scrollInfo = editor.getScrollInfo();
            editor.scrollTo(null, scrollRatio * (scrollInfo.height - scrollInfo.clientHeight));
            isSyncingPreview = false;
        });

        editor.on("cursorActivity", function() {
            const content = editor.getValue();
            const from = editor.getCursor("from");
            const to = editor.getCursor("to");

            const start = editor.indexFromPos(from);
            const end = editor.indexFromPos(to);

            let highlighted = content.substring(0, start)
                + "<mark>" + content.substring(start, end) + "</mark>"
                + content.substring(end);

            document.getElementById("preview").innerHTML = marked.parse(highlighted);
        });
    </script>
</body>
</html>