<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `loan_types` (3 rows), exported from the live schema. Safe to re-run. */
class LoanTypesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'label' => 'Personal Loan', 'rate' => '10.55', 'status' => 1, 'payment' => 1],
            ['id' => 2, 'label' => 'Business Loan', 'rate' => '12.55', 'status' => 1, 'payment' => 1],
            ['id' => 3, 'label' => 'Credit Card', 'rate' => '0', 'status' => 1, 'payment' => 0],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('loan_types')->insertOrIgnore($chunk);
        }
    }
}
