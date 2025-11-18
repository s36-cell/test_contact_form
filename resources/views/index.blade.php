<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>

    <style>
        body {
            width: 60%;
            margin: 40px auto;
            font-family: Arial, sans-serif;
            font-size: 15px;
            color: #333;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 25px;
            border-left: 6px solid #333;
            padding-left: 10px;
        }

        /* ▼ エラーメッセージ枠 */
        .error-box {
            background: #ffecec;
            color: #cc0000;
            border: 1px solid #ffb3b3;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 25px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-row {
            margin-bottom: 18px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .btn-area {
            text-align: center;
            margin-top: 20px;
        }

        .btn-submit {
            background: #000;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

    <h1>お問い合わせ</h1>

    {{-- ▼ バリデーションエラー（赤枠＋整った UI） --}}
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/confirm" method="POST">
        @csrf

        <div class="form-row">
            <label>お名前（姓）</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}">
        </div>

        <div class="form-row">
            <label>お名前（名）</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}">
        </div>

        <div class="form-row">
            <label>性別</label>
            <select name="gender">
                <option value="">選択してください</option>
                <option value="男性" {{ old('gender')=='男性' ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ old('gender')=='女性' ? 'selected' : '' }}>女性</option>
                <option value="その他" {{ old('gender')=='その他' ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="form-row">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-row">
            <label>電話番号</label>
            <input type="text" name="tel" value="{{ old('tel') }}">
        </div>

        <div class="form-row">
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>

        <div class="form-row">
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building') }}">
        </div>

        <div class="form-row">
            <label>お問い合わせの種類</label>
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label>お問い合わせ内容</label>
            <textarea name="detail">{{ old('detail') }}</textarea>
        </div>

        <div class="btn-area">
            <button type="submit" class="btn-submit">確認画面へ</button>
        </div>

    </form>

</body>
</html>