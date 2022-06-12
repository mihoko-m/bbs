<?php

use Illuminate\Database\Seeder;
use App\Faculty;
class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Faculty::create([
            'name' => '法学部',
            'department_name' => '法学政治学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '経済学部',
            'department_name' => '経済学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '商学部',
            'department_name' => '商学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '文学部',
            'department_name' => '総合人文学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '社会学部',
            'department_name' => '社会学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '総合情報学部',
            'department_name' => '総合情報学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '政策創造学部',
            'department_name' => '政策学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '政策創造学部',
            'department_name' => '国際アジア学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => 'システム理工学部',
            'department_name' => '数学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => 'システム理工学部',
            'department_name' => '物理・応用物理学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => 'システム理工学部',
            'department_name' => '機械工学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => 'システム理工学部',
            'department_name' => '電気電子情報工学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '環境都市工学部',
            'department_name' => '建築学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '環境都市工学部',
            'department_name' => '都市システム工学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '環境都市工学部',
            'department_name' => 'エネルギー・環境工学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '化学生命工学部',
            'department_name' => '化学・物質工学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '化学生命工学部',
            'department_name' => '生命・生物工学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '外国語学部',
            'department_name' => '外国語学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '人間健康学部',
            'department_name' => '人間健康学科',
            'created_at' => now(),
        ]);
        
        Faculty::create([
            'name' => '社会安全学部',
            'department_name' => '安全マネジメント学科',
            'created_at' => now(),
        ]);
    }
}
