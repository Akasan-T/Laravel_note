<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdownエディタ作成</title>
    <!-- CodeMirror CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/idea.min.css">
    <style>
        body { 
            font-family: sans-serif; 
            margin: 0 70px; 
            overflow: hidden;
        }

        .editor-container{
            display:flex;
        }

        label { 
            font-weight: bold; 
        
        }
        .CodeMirror {
            font-family: 'Fira Code', monospace;
            border: 1px solid #333;
            width: 650px;
            height: 600px;
        }

        .preview-container{
            margin-top:165px;
            margin-left:50px;
        }

        #preview {
            font-family: 'Fira Code', monospace;
            background: #fafafa;
            overflow:auto;
            padding:0 1em;
            border:1px solid #333;
            width: 650px;
            height: 600px;
            margin:0;
        }

        #title{
            width: 645px;
            height: 40px;
            font-size:25px;
        }

    </style>
</head>
<body>
<div class="editor-container">
    <!-- Markdown入力側 -->
    <div class="editor">
        <h1>Markdownエディタ</h1>
        <form method="POST" action="{{ route('notes.store') }}">
            @csrf
            <label for="title">タイトル</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="editor">内容 (Markdown)</label>
            <textarea id="editor" name="content"></textarea>
            <br>
            <button type="submit">保存</button>
        </form>
    </div>

    <!-- プレビュー側 -->
    <div class="preview-container">
        <label for="preview">プレビュー</label>
        <div id="preview"></div>
    </div>
</div>

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
</script>
</body>
</html>