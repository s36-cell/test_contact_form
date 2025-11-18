<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>

    <style>
        body {
            background: #f5f5f5;
            font-family: "Hiragino Sans", sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
            width: 420px;
            margin: 80px auto;
            background: #fff;
            padding: 35px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: bold;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 15px;
        }

        /* エラー表示 */
        .error-box {
            background: #fdecea;
            color: #b71c1c;
            padding: 12px;
            border-left: 5px solid #f44336;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        /* ボタン */
        .btn-login {
            width: 100%;
            background: #000;
            color: #fff;
            padding: 12px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-login:hover {
            opacity: 0.85;
        }

        /* リンク */
        .link-area {
            text-align: center;
            margin-top: 20px;
        }

        .link-area a {
            color: #0066cc;
            text-decoration: none;
            font-size: 15px;
        }

        .link-area a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>

    <div class="login-container">

        <h1>ログイン</h1>

        {{-- エラー表示 --}}
        @if ($errors->any())
            <div class="error-box">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>パスワード</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn-login">ログイン</button>
        </form>

        <div class="link-area">
            <p><a href="/register">▶ 新規登録はこちら</a></p>
        </div>

    </div>

</body>
</html>