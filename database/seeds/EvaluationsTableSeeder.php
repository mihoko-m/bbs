<?php

use Illuminate\Database\Seeder;
use App\Evaluation;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluation::create([
            'name' => '定期試験のみ',
            'created_at' => now(),
        ]);
        
        Evaluation::create([
            'name' => '平常点（授業内での課題）のみ',
            'created_at' => now(),
        ]);
        
        Evaluation::create([
            'name' => '平常点と定期試験',
            'created_at' => now(),
        ]);
        
        Evaluation::create([
            'name' => '平常点とレポート',
            'created_at' => now(),
        ]);
        
        Evaluation::create([
            'name' => 'レポートのみ',
            'created_at' => now(),
        ]);
        
        Evaluation::create([
            'name' => 'その他',
            'created_at' => now(),
        ]);
    }
}
