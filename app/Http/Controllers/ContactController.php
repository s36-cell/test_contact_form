<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    /* ---------------------------------------------------
        1. 入力画面
    --------------------------------------------------- */
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    /* ---------------------------------------------------
        2. 確認画面（入力値を受け取り確認画面へ）
    --------------------------------------------------- */
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->validated();

        // カテゴリー名を取得
        $category = Category::find($inputs['category_id']);
        $category_name = $category ? $category->content : '';

        return view('confirm', [
            'last_name'     => $inputs['last_name'],
            'first_name'    => $inputs['first_name'],
            'gender'        => $inputs['gender'],
            'email'         => $inputs['email'],
            'tel'           => $inputs['tel'],
            'address'       => $inputs['address'],
            'building'      => $inputs['building'],
            'category_id'   => $inputs['category_id'],
            'category_name' => $category_name,
            'detail'        => $inputs['detail'],
        ]);
    }

    /* ---------------------------------------------------
        3. 完了画面（DB へ保存→thanks 表示）
    --------------------------------------------------- */
    public function store(ContactRequest $request)
    {
        $validated = $request->validated();
        Contact::create($validated);

        return view('thanks');
    }

    /* ---------------------------------------------------
        4. 管理画面（検索 + 8件ページネーション）
    --------------------------------------------------- */
    public function adminIndex(Request $request)
    {
        $query = Contact::with('category');

        // 名前
        if (!empty($request->name)) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->name}%")
                    ->orWhere('first_name', 'like', "%{$request->name}%");
            });
        }

        // メール
        if (!empty($request->email)) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // 性別
        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        // カテゴリー
        if (!empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // 日付（from）
        if (!empty($request->from)) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // 日付（to）
        if (!empty($request->to)) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // ページネーション（要件：8件）
        $contacts = $query->orderBy('created_at', 'desc')->paginate(8);

        // カテゴリー一覧
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    /* ---------------------------------------------------
        5. 詳細画面
    --------------------------------------------------- */
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    /* ---------------------------------------------------
        6. 削除処理
    --------------------------------------------------- */
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/admin')->with('message', '削除しました');
    }

    /* ---------------------------------------------------
        7. 編集画面
    --------------------------------------------------- */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $categories = Category::all();

        return view('admin.edit', compact('contact', 'categories'));
    }

    /* ---------------------------------------------------
        8. 更新処理
    --------------------------------------------------- */
    public function update(ContactRequest $request, $id)
    {
        $validated = $request->validated();

        $contact = Contact::findOrFail($id);
        $contact->update($validated);

        return redirect()->route('admin.index')->with('success', '更新しました');
    }

    /* ---------------------------------------------------
        9. CSV エクスポート（現在の検索結果を出力）
    --------------------------------------------------- */
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::with('category');

        // adminIndex と同じ条件を再適用
        if (!empty($request->name)) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->name}%")
                    ->orWhere('first_name', 'like', "%{$request->name}%");
            });
        }
        if (!empty($request->email)) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }
        if (!empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }
        if (!empty($request->from)) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if (!empty($request->to)) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $response = new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');

            // CSV ヘッダ
            fputcsv($handle, [
                'ID', '姓', '名', '性別', 'メール', '電話番号',
                '住所', '建物名', 'お問い合わせ種類',
                'お問い合わせ内容', '登録日時'
            ]);

            // データ
            $query->chunk(100, function ($contacts) use ($handle) {
                foreach ($contacts as $c) {
                    fputcsv($handle, [
                        $c->id,
                        $c->last_name,
                        $c->first_name,
                        $c->gender,
                        $c->email,
                        $c->tel,
                        $c->address,
                        $c->building,
                        optional($c->category)->content,
                        $c->detail,
                        optional($c->created_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'"');

        return $response;
    }
}