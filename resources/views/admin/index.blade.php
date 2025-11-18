<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問い合わせ管理</title>

    <style>
        body {
            width: 90%;
            margin: 30px auto;
            font-size: 15px;
            font-family: "Hiragino Sans", "Helvetica", "Arial", sans-serif;
            background: #fafafa;
            color: #333;
        }

        h1 {
            margin-bottom: 25px;
            font-size: 24px;
            border-left: 6px solid #333;
            padding-left: 10px;
        }

        /* ===== メッセージ ===== */
        .flash-message {
            padding: 12px;
            background: #d4edda;
            color: #155724;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        /* ===== 検索フォーム全体 ===== */
        .search-box {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 25px;
        }

        .search-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .search-group {
            flex: 1;
        }

        .search-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        .search-group input[type="text"],
        .search-group input[type="email"],
        .search-group input[type="date"],
        .search-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-search,
        .btn-reset,
        .btn-export {
            padding: 8px 20px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-search {
            background: #000;
            color: #fff;
        }

        .btn-reset {
            background: #777;
            color: #fff;
        }

        .btn-export {
            background: #f3a500;
            color: #fff;
        }

        /* ===== テーブル ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            font-size: 14px;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        /* 行ホバー（要件の hover） */
        tbody tr:hover {
            background: #f9f1e7;
        }

        /* ===== 一覧内ボタン ===== */
        .btn-detail,
        .btn-edit {
            background: #000;
            color: #fff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
        }

        .btn-delete {
            background: red;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-delete:hover {
            opacity: 0.8;
        }

        .pagination {
            margin-top: 20px;
        }

        /* ===== モーダル ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            width: 60%;
            max-width: 700px;
            border-radius: 8px;
            padding: 20px 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
        }

        .modal-close {
            border: none;
            background: none;
            font-size: 20px;
            cursor: pointer;
        }

        .modal-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .modal-table th,
        .modal-table td {
            border: 1px solid #e0e0e0;
            padding: 8px 10px;
        }

        .modal-table th {
            width: 30%;
            background: #f5f5f5;
            text-align: left;
        }

        .modal-footer {
            text-align: right;
            margin-top: 10px;
        }

        .btn-modal-close {
            padding: 6px 16px;
            border-radius: 4px;
            border: none;
            background: #777;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h1>お問い合わせ管理</h1>

        <form method="POST" action="/logout">
            @csrf
            <button
                style="background:#555;color:#fff;padding:8px 16px;border:none;
                        border-radius:4px;cursor:pointer;">
                ログアウト
            </button>
        </form>
    </div>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('message'))
        <div class="flash-message">
            {{ session('message') }}
        </div>
    @endif

    {{-- ========================= --}}
    {{-- ▼ 検索フォーム --}}
    {{-- ========================= --}}
    <div class="search-box">
        <form method="GET" action="/admin">
            <div class="search-row">
                <div class="search-group">
                    <label>お名前</label>
                    <input type="text" name="name" value="{{ request('name') }}">
                </div>
                <div class="search-group">
                    <label>メールアドレス</label>
                    <input type="email" name="email" value="{{ request('email') }}">
                </div>
            </div>

            <div class="search-row">
                <div class="search-group">
                    <label>性別</label>
                    <select name="gender">
                        <option value="">選択してください</option>
                        <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                        <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
                        <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="search-group">
                    <label>お問い合わせ種類</label>
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="search-row">
                <div class="search-group">
                    <label>日付（from）</label>
                    <input type="date" name="from" value="{{ request('from') }}">
                </div>
                <div class="search-group">
                    <label>日付（to）</label>
                    <input type="date" name="to" value="{{ request('to') }}">
                </div>
            </div>

            <div class="search-buttons">
                <button type="submit" class="btn-search">検索する</button>
                <button type="button" class="btn-reset" onclick="location.href='/admin'">リセット</button>
            </div>
        </form>
    </div>
    {{-- ==========================
    CSV 出力ボタン
    ========================== --}}
    <div style="text-align: right; margin-bottom: 15px;">
        <a href="{{ route('admin.export', request()->query()) }}"
            style="padding: 10px 20px; background: #333; color: #fff;
                border-radius: 4px; text-decoration: none;">
            CSV出力
        </a>
    </div>

    {{-- ========================= --}}
    {{-- ▼ 検索結果一覧テーブル --}}
    {{-- ========================= --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>性別</th>
                <th>メール</th>
                <th>種類</th>
                <th>登録日</th>
                <th colspan="3">操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contacts as $contact)
                <tr
                    class="contact-row"
                    data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                    data-gender="{{ $contact->gender }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category->content }}"
                    data-detail="{{ $contact->detail }}"
                    data-created="{{ $contact->created_at->format('Y-m-d H:i:s') }}"
                >
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>

                    <td>
                        {{-- モーダル表示用ボタン --}}
                        <button type="button" class="btn-detail js-open-modal">モーダル</button>
                    </td>
                    <td>
                        {{-- 別ページの詳細画面（要件の「詳細画面」も維持） --}}
                        <a href="{{ route('admin.show', $contact->id) }}" class="btn-detail">詳細</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.edit', $contact->id) }}" class="btn-edit">編集</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.delete', $contact->id) }}" method="post"
                            onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            <button type="submit" class="btn-delete">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション（8件ごと） --}}
    <div class="pagination">
        {{ $contacts->links() }}
    </div>

    {{-- ========================= --}}
    {{-- ▼ モーダル本体 --}}
    {{-- ========================= --}}
    <div class="modal-overlay" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>お問い合わせ詳細</h2>
                <button class="modal-close" type="button" id="modalCloseBtn">×</button>
            </div>

            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td id="modalName"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="modalGender"></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="modalEmail"></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td id="modalTel"></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td id="modalAddress"></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td id="modalBuilding"></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="modalCategory"></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td id="modalDetail"></td>
                </tr>
                <tr>
                    <th>登録日時</th>
                    <td id="modalCreated"></td>
                </tr>
            </table>

            <div class="modal-footer">
                <button type="button" class="btn-modal-close" id="modalFooterCloseBtn">閉じる</button>
            </div>
        </div>
    </div>

    <script>
        // モーダル開閉処理
        const modal = document.getElementById('detailModal');
        const closeBtn = document.getElementById('modalCloseBtn');
        const footerCloseBtn = document.getElementById('modalFooterCloseBtn');

        function openModal(row) {
            document.getElementById('modalName').textContent = row.dataset.name;
            document.getElementById('modalGender').textContent = row.dataset.gender;
            document.getElementById('modalEmail').textContent = row.dataset.email;
            document.getElementById('modalTel').textContent = row.dataset.tel;
            document.getElementById('modalAddress').textContent = row.dataset.address;
            document.getElementById('modalBuilding').textContent = row.dataset.building;
            document.getElementById('modalCategory').textContent = row.dataset.category;
            document.getElementById('modalDetail').textContent = row.dataset.detail;
            document.getElementById('modalCreated').textContent = row.dataset.created;

            modal.style.display = 'flex';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        // 各「モーダル」ボタンにイベント付与
        document.querySelectorAll('.js-open-modal').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const row = this.closest('.contact-row');
                openModal(row);
            });
        });

        closeBtn.addEventListener('click', closeModal);
        footerCloseBtn.addEventListener('click', closeModal);

        // 背景クリックで閉じる
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    </script>

</body>
</html>