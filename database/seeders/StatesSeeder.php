<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `states` (36 rows), exported from the live schema. Safe to re-run. */
class StatesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'name' => 'Andhra Pradesh', 'status' => 0],
            ['id' => 2, 'name' => 'Arunachal Pradesh', 'status' => 0],
            ['id' => 3, 'name' => 'Assam', 'status' => 0],
            ['id' => 4, 'name' => 'Bihar', 'status' => 0],
            ['id' => 5, 'name' => 'Chhattisgarh', 'status' => 0],
            ['id' => 6, 'name' => 'Goa', 'status' => 0],
            ['id' => 7, 'name' => 'Gujarat', 'status' => 0],
            ['id' => 8, 'name' => 'Haryana', 'status' => 0],
            ['id' => 9, 'name' => 'Himachal Pradesh', 'status' => 0],
            ['id' => 10, 'name' => 'Jharkhand', 'status' => 0],
            ['id' => 11, 'name' => 'Karnataka', 'status' => 0],
            ['id' => 12, 'name' => 'Kerala', 'status' => 0],
            ['id' => 13, 'name' => 'Madhya Pradesh', 'status' => 0],
            ['id' => 14, 'name' => 'Maharashtra', 'status' => 0],
            ['id' => 15, 'name' => 'Manipur', 'status' => 0],
            ['id' => 16, 'name' => 'Meghalaya', 'status' => 0],
            ['id' => 17, 'name' => 'Mizoram', 'status' => 0],
            ['id' => 18, 'name' => 'Nagaland', 'status' => 0],
            ['id' => 19, 'name' => 'Odisha', 'status' => 0],
            ['id' => 20, 'name' => 'Punjab', 'status' => 0],
            ['id' => 21, 'name' => 'Rajasthan', 'status' => 0],
            ['id' => 22, 'name' => 'Sikkim', 'status' => 0],
            ['id' => 23, 'name' => 'Tamil Nadu', 'status' => 0],
            ['id' => 24, 'name' => 'Telangana', 'status' => 0],
            ['id' => 25, 'name' => 'Tripura', 'status' => 0],
            ['id' => 26, 'name' => 'Uttar Pradesh', 'status' => 0],
            ['id' => 27, 'name' => 'Uttarakhand', 'status' => 0],
            ['id' => 28, 'name' => 'West Bengal', 'status' => 0],
            ['id' => 29, 'name' => 'Andaman and Nicobar Islands', 'status' => 0],
            ['id' => 30, 'name' => 'Chandigarh', 'status' => 0],
            ['id' => 31, 'name' => 'Dadra and Nagar Haveli and Daman and Diu', 'status' => 0],
            ['id' => 32, 'name' => 'Delhi', 'status' => 0],
            ['id' => 33, 'name' => 'Jammu and Kashmir', 'status' => 0],
            ['id' => 34, 'name' => 'Ladakh', 'status' => 0],
            ['id' => 35, 'name' => 'Lakshadweep', 'status' => 0],
            ['id' => 36, 'name' => 'Puducherry', 'status' => 0],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('states')->insertOrIgnore($chunk);
        }
    }
}
