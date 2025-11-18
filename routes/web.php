<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// 入力 → 確認 → 完了
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

// === 管理者ページ（ログイン必須） ===
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [ContactController::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/show/{id}', [ContactController::class, 'show'])->name('admin.show');
    Route::post('/admin/delete/{id}', [ContactController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/edit/{id}', [ContactController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [ContactController::class, 'update'])->name('admin.update');

    // ★ 絞り込み結果のエクスポート
    Route::get('/export', [ContactController::class, 'export'])->name('admin.export');
});