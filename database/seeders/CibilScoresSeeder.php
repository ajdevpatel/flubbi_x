<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `cibil_scores` (4 rows), exported from the live schema. Safe to re-run. */
class CibilScoresSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'label' => '550 - 650', 'status' => 1],
            ['id' => 2, 'label' => '651 - 750', 'status' => 1],
            ['id' => 3, 'label' => '751 - 850', 'status' => 1],
            ['id' => 4, 'label' => 'Above 850', 'status' => 1],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('cibil_scores')->insertOrIgnore($chunk);
        }
    }
}
