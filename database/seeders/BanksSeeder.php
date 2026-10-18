<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `banks` (3 rows), exported from the live schema. Safe to re-run. */
class BanksSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'name' => 'HDFC Bank', 'logo' => 'banks/hdfc.png', 'pl_rate' => '10.50', 'bl_rate' => '12.00', 'status' => 1],
            ['id' => 2, 'name' => 'ICICI Bank', 'logo' => 'banks/icici.png', 'pl_rate' => '10.75', 'bl_rate' => '12.25', 'status' => 1],
            ['id' => 3, 'name' => 'Axis Bank', 'logo' => 'banks/axis.png', 'pl_rate' => '11.00', 'bl_rate' => '12.50', 'status' => 1],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('banks')->insertOrIgnore($chunk);
        }
    }
}
