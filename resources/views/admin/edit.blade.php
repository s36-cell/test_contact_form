<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問い合わせ編集</title>

    <style>
        body {
            width: 70%;
            margin: 40px auto;
            font-family: "Hiragino Sans", sans-serif;
            font-size: 15px;
            background: #fafafa;
            color: #333;
        }

        h1 {
            margin-bottom: 25px;
            border-left: 6px solid #333;
            padding-left: 10px;
            font-size: 24px;
        }

        form {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 120px;
        }

        .btn-area {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-submit {
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: #777;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<h1>お問い合わせ編集</h1>

<form action="{{ route('admin.update', $contact->id) }}" method="POST">
    @csrf

    <label>姓</label>
    <input type="text" name="last_name" value="{{ old('last_name', $contact->last_name) }}">

    <label>名</label>
    <input type="text" name="first_name" value="{{ old('first_name', $contact->first_name) }}">

    <label>性別</label>
    <select name="gender">
        <option value="男性" {{ $contact->gender == '男性' ? 'selected' : '' }}>男性</option>
        <option value="女性" {{ $contact->gender == '女性' ? 'selected' : '' }}>女性</option>
        <option value="その他" {{ $contact->gender == 'その他' ? 'selected' : '' }}>その他</option>
    </select>

    <label>メール</label>
    <input type="email" name="email" value="{{ old('email', $contact->email) }}">

    <label>電話番号</label>
    <input type="text" name="tel" value="{{ old('tel', $contact->tel) }}">

    <label>住所</label>
    <input type="text" name="address" value="{{ old('address', $contact->address) }}">

    <label>建物名</label>
    <input type="text" name="building" value="{{ old('building', $contact->building) }}">

    <label>お問い合わせ種類</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $contact->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
            </option>
        @endforeach
    </select>

    <label>お問い合わせ内容</label>
    <textarea name="detail">{{ old('detail', $contact->detail) }}</textarea>

    <div class="btn-area">
        <button type="submit" class="btn-submit">更新する</button>
        <a href="/admin" class="btn-back">戻る</a>
    </div>

</form>

</body>
</html>