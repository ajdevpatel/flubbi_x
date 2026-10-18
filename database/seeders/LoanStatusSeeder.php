<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `loan_status` (7 rows), exported from the live schema. Safe to re-run. */
class LoanStatusSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'label' => 'Pending', 'status' => 1, 'priority' => 1],
            ['id' => 2, 'label' => 'Under Review', 'status' => 1, 'priority' => 2],
            ['id' => 3, 'label' => 'Approved', 'status' => 1, 'priority' => 3],
            ['id' => 4, 'label' => 'Rejected', 'status' => 1, 'priority' => 4],
            ['id' => 5, 'label' => 'Disbursed', 'status' => 1, 'priority' => 5],
            ['id' => 6, 'label' => 'Closed', 'status' => 1, 'priority' => 6],
            ['id' => 7, 'label' => 'Document Pending', 'status' => 1, 'priority' => 2],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('loan_status')->insertOrIgnore($chunk);
        }
    }
}
