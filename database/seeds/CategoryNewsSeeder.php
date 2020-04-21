<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\ParserController;

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

        $categories = ParserController::category();
        $result=[];

        foreach ($categories as $item){
            $result[]=[
                'category'=>$item,
                'category_alias'=>Str::slug($item, '-'),
            ];
        }

        return   $result;
    }
}
