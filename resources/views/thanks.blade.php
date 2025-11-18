<DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>送信完了</title>

    <style>
        body {
            font-family: "Hiragino Sans", "Helvetica", "Arial", sans-serif;
            background: #fafafa;
            margin: 0;
            padding: 0;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            color: #333;
        }

        .container {
            background: #fff;
            width: 90%;
            max-width: 500px;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #000;
        }

        p {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .btn-back {
            display: inline-block;
            padding: 12px 30px;
            font-size: 15px;
            background: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-back:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>送信が完了しました</h1>

        <p>
            お問い合わせいただきありがとうございます。<br>
            内容を確認の上、担当者よりご連絡いたします。
        </p>

        <a href="/" class="btn-back">トップページへ戻る</a>
    </div>

</body>
</html>