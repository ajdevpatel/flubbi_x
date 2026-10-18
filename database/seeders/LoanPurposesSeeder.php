<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `loan_purposes` (10 rows), exported from the live schema. Safe to re-run. */
class LoanPurposesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'label' => 'Personal Expenses', 'status' => 1],
            ['id' => 2, 'label' => 'Medical Emergency', 'status' => 1],
            ['id' => 3, 'label' => 'Education', 'status' => 1],
            ['id' => 4, 'label' => 'Business Expansion', 'status' => 1],
            ['id' => 5, 'label' => 'Home Renovation', 'status' => 1],
            ['id' => 6, 'label' => 'Wedding', 'status' => 1],
            ['id' => 7, 'label' => 'Travel', 'status' => 1],
            ['id' => 8, 'label' => 'Debt Consolidation', 'status' => 1],
            ['id' => 9, 'label' => 'Vehicle Purchase', 'status' => 1],
            ['id' => 10, 'label' => 'Other', 'status' => 1],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('loan_purposes')->insertOrIgnore($chunk);
        }
    }
}
