<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_type')->insert(self::makeData());
    }

    private static function makeData(): array
    {
        $arr = [];
        for ($i = 1; $i <= 150; $i++) {

            $arr[] = [
                'task_id' => $i,
                'type_id' => rand(1, 3),
            ];
        }

        return $arr;
    }
}
