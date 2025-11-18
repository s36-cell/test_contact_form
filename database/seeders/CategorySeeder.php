<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 外部キー制約を一時的に解除
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 商品問い合わせ用カテゴリー
        $categories = [
            ['content' => '商品のお問い合わせ'],
            ['content' => 'ご意見・ご感想'],
            ['content' => 'その他'],
        ];

        DB::table('categories')->insert($categories);
    }
}