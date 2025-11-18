<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容の確認</title>

    <style>
        body {
            width: 60%;
            margin: 60px auto;
            font-family: "Hiragino Sans", sans-serif;
            font-size: 17px;
            color: #333;
        }

        h1 {
            font-size: 24px;
            border-left: 6px solid #333;
            padding-left: 10px;
            margin-bottom: 25px;
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
            width: 30%;
            background: #f9f9f9;
            text-align: left;
        }

        .btn-area {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button, .btn-back {
            padding: 10px 25px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button {
            background: black;
            color: white;
        }

        .btn-back {
            background: #aaa;
            color: #fff;
            text-decoration: none;
            display: inline-block;
        }

        button:hover, .btn-back:hover {
            opacity: .8;
        }
    </style>
</head>

<body>

<h1>入力内容の確認</h1>

<table>
    <tr>
        <th>お名前</th>
        <td>{{ $last_name }} {{ $first_name }}</td>
    </tr>

    <tr>
        <th>性別</th>
        <td>{{ $gender }}</td>
    </tr>

    <tr>
        <th>メールアドレス</th>
        <td>{{ $email }}</td>
    </tr>

    <tr>
        <th>電話番号</th>
        <td>{{ $tel }}</td>
    </tr>

    <tr>
        <th>住所</th>
        <td>{{ $address }}</td>
    </tr>

    <tr>
        <th>建物名</th>
        <td>{{ $building }}</td>
    </tr>

    <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $category_name }}</td>
    </tr>

    <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $detail }}</td>
    </tr>
</table>

{{-- 送信用フォーム --}}
<form action="/thanks" method="post">
    @csrf
    <input type="hidden" name="last_name" value="{{ $last_name }}">
    <input type="hidden" name="first_name" value="{{ $first_name }}">
    <input type="hidden" name="gender" value="{{ $gender }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="tel" value="{{ $tel }}">
    <input type="hidden" name="address" value="{{ $address }}">
    <input type="hidden" name="building" value="{{ $building }}">
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    <input type="hidden" name="detail" value="{{ $detail }}">

    <div class="btn-area">
        <a href="javascript:history.back()" class="btn-back">戻る</a>
        <button type="submit">送信する</button>
    </div>
</form>

</body>
</html>