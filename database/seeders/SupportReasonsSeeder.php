<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `support_reasons` (6 rows), exported from the live schema. Safe to re-run. */
class SupportReasonsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'label' => 'Loan Application Issue', 'status' => 1],
            ['id' => 2, 'label' => 'Payment Related', 'status' => 1],
            ['id' => 3, 'label' => 'Document Verification', 'status' => 1],
            ['id' => 4, 'label' => 'Loan Status Delay', 'status' => 1],
            ['id' => 5, 'label' => 'App / Technical Issue', 'status' => 1],
            ['id' => 6, 'label' => 'Other', 'status' => 1],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('support_reasons')->insertOrIgnore($chunk);
        }
    }
}
