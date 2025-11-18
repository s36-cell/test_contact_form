<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ詳細</title>
    <style>
        body {
            width: 70%;
            margin: 40px auto;
            font-family: "Hiragino Sans", sans-serif;
            font-size: 15px;
            color: #333;
            background: #fafafa;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 25px;
            border-left: 6px solid #333;
            padding-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        th {
            width: 25%;
            background: #f2f2f2;
            text-align: left;
        }

        .btn-area {
            text-align: right;
            margin-top: 20px;
        }

        .btn-back {
            background: #777;
            color: #fff;
            padding: 10px 18px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-edit {
            background: #000;
            color: #fff;
            padding: 10px 18px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 10px;
        }
    </style>
</head>

<body>

<h1>お問い合わせ詳細</h1>

<table>
    <tr><th>ID</th><td>{{ $contact->id }}</td></tr>
    <tr><th>お名前</th><td>{{ $contact->last_name }} {{ $contact->first_name }}</td></tr>
    <tr><th>性別</th><td>{{ $contact->gender }}</td></tr>
    <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
    <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
    <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
    <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
    <tr><th>お問い合わせの種類</th><td>{{ $contact->category->content }}</td></tr>
    <tr><th>お問い合わせ内容</th><td style="white-space: pre-wrap;">{{ $contact->detail }}</td></tr>
    <tr><th>登録日時</th><td>{{ $contact->created_at->format('Y-m-d H:i') }}</td></tr>
</table>

<div class="btn-area">
    <a href="{{ route('admin.edit', $contact->id) }}" class="btn-edit">編集</a>
    <a href="/admin" class="btn-back">一覧に戻る</a>
</div>

</body>
</html>