DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規会員登録</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Hiragino Sans", "Helvetica", "Arial", sans-serif;
            background: #f5f5f5;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-card {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            width: 380px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 22px;
            margin: 0 0 20px;
            text-align: center;
        }

        .error-box {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 10px 12px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 18px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            max-width: 320px;
            box-sizing: border-box;
            padding: 8px 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .input-error {
            border-color: #e3342f;
        }

        .error-message {
            color: #e3342f;
            font-size: 12px;
            margin-top: 3px;
        }

        .btn-submit {
            margin-top: 10px;
            width: 100%;
            max-width: 320px;
            padding: 10px 0;
            border-radius: 4px;
            border: none;
            background: #000;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: 0.85;
        }

        .link-area {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
        }

        .link-area a {
            color: #007bff;
            text-decoration: none;
        }

        .link-area a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <h1>新規会員登録</h1>

        {{-- 全体エラー表示 --}}
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            {{-- 名前 --}}
            <div class="form-group">
                <label for="name">お名前</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="@error('name') input-error @enderror"
                    required
                    autofocus
                >
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- メールアドレス --}}
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="@error('email') input-error @enderror"
                    required
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label for="password">パスワード</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="@error('password') input-error @enderror"
                    required
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- パスワード確認 --}}
            <div class="form-group">
                <label for="password_confirmation">パスワード（確認）</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                >
            </div>

            <button type="submit" class="btn-submit">登録する</button>
        </form>

        <div class="link-area">
            すでにアカウントをお持ちの方は
            <a href="/login">こちらからログイン</a>
        </div>

    </div>
</div>

</body>
</html>