# 📒 Code Note

> コードやメモをMarkdown形式で整理・管理できる個人向けWebアプリケーション

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

---

## 📌 概要

エンジニアが自分のコードスニペットやメモを一元管理するためのWebアプリです。  
Markdownエディタを搭載し、リアルタイムプレビューで快適にノートを作成できます。  
ラベル機能でノートを分類・整理でき、画像の埋め込みにも対応しています。

---

## 🛠️ 技術スタック

| カテゴリ | 使用技術 |
|---|---|
| バックエンド | PHP / Laravel |
| フロントエンド | HTML / CSS / JavaScript |
| データベース | MySQL |
| エディタ | CodeMirror（リッチテキストエディタ） |
| Markdown変換 | commonmark |

---

## ✨ 主な機能

- **ユーザー認証** ― 新規登録・ログイン・ログアウト
- **ノート管理** ― 作成・編集・削除（CRUD）
- **Markdownリアルタイムプレビュー** ― CodeMirrorによるコードハイライト付きエディタ
- **ラベル管理** ― ノートへのラベル付けとフィルタリング
- **画像挿入** ― ノート内への画像アップロード・埋め込み

---

## 🔧 設計のポイント

- **MVC アーキテクチャ** ― Laravelの設計パターンに従ったコード構成
- **認証機能** ― Laravel Breezeを用いたセキュアなユーザー認証
- **リアルタイムUI** ― JavaScriptによるMarkdownのリアルタイムプレビュー実装
- **ライブラリ活用** ― OSSライブラリの選定・統合の経験

---

## 🚀 今後追加したい機能

- PDF書き出し機能
- 複数ユーザーによるリアルタイム共同編集（WebSocket活用）
