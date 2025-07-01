<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_task')->insert(self::makeData());
    }

    private static function makeData(): array
    {
        $arr = [];
        for ($i = 1; $i <= 150; $i++) {

            $arr[] = [
                'category_id' => rand(1, 3),
                'task_id' => $i,
            ];
        }

        return $arr;
    }
}
