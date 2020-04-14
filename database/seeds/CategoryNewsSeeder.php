<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_news')->insert($this->getCategory());
    }

    private function getCategory()
    {


        $category = [
            [
                'category' => 'В мире',
                'category_alias' => Str::slug('В мире', '-')
                
            ],
            [
                'category' => 'Бизнес',
                'category_alias' => Str::slug('Бизнес', '-')
            ],
            [
                'category' => 'Спорт',
                'category_alias' => Str::slug('Спорт', '-')
            ],
        ];


        return $category;
    }
}
