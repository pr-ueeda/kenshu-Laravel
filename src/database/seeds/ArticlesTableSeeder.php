<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('articles')->insert([
            ['title'      => 'コロナウイルスについて',
            'body'       => '今年の1月頃から日本での感染も確認が得られたコロナウイルスですが、
                             今現在(5月1日)その勢いは止まることを知りません。
                             コロナウイルスは世界中の国や人々に経済、健康、安全面などで様々な
                             悪影響を及ぼしました。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
                'title' => 'プログラミングについて',
                'body'  => 'プログラミングは楽しいです。難しい時や考えて考えても前に進めない
                            時もありますが、自分が書いたプログラムが動いた時には大変な達成感を得ることができます。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ]);
    }
}
