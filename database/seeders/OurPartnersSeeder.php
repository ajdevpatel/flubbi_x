<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `our_partners` (32 rows), exported from the live schema. Safe to re-run. */
class OurPartnersSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'name' => 'Axis Bank', 'logo' => '001.png', 'order_no' => 1, 'status' => 0],
            ['id' => 2, 'name' => 'Yes Bank', 'logo' => '002.png', 'order_no' => 2, 'status' => 0],
            ['id' => 3, 'name' => 'ICICI Bank', 'logo' => '003.png', 'order_no' => 3, 'status' => 0],
            ['id' => 4, 'name' => 'Kotak Mahindra Bank', 'logo' => '004.png', 'order_no' => 4, 'status' => 0],
            ['id' => 5, 'name' => 'HDFC Bank', 'logo' => '005.png', 'order_no' => 5, 'status' => 0],
            ['id' => 6, 'name' => 'TATA Capital', 'logo' => '006.png', 'order_no' => 6, 'status' => 0],
            ['id' => 7, 'name' => 'Indusind Bank', 'logo' => '007.png', 'order_no' => 7, 'status' => 0],
            ['id' => 8, 'name' => 'SBI Bank', 'logo' => '008.png', 'order_no' => 8, 'status' => 0],
            ['id' => 9, 'name' => 'IDBI Bank', 'logo' => '009.png', 'order_no' => 9, 'status' => 0],
            ['id' => 10, 'name' => 'Bandhan Bank', 'logo' => '010.png', 'order_no' => 10, 'status' => 0],
            ['id' => 11, 'name' => 'Union Bank', 'logo' => '011.png', 'order_no' => 11, 'status' => 0],
            ['id' => 12, 'name' => 'RBL Bank', 'logo' => '012.png', 'order_no' => 12, 'status' => 0],
            ['id' => 13, 'name' => 'Aditya Birla Capital', 'logo' => '013.png', 'order_no' => 13, 'status' => 0],
            ['id' => 14, 'name' => 'Indiabulls', 'logo' => '014.png', 'order_no' => 14, 'status' => 0],
            ['id' => 15, 'name' => 'Faircent.com', 'logo' => '015.png', 'order_no' => 15, 'status' => 0],
            ['id' => 16, 'name' => 'Fullertor India', 'logo' => '016.png', 'order_no' => 16, 'status' => 0],
            ['id' => 17, 'name' => 'DCB Bank', 'logo' => '017.png', 'order_no' => 17, 'status' => 0],
            ['id' => 18, 'name' => 'Grihashakti', 'logo' => '018.png', 'order_no' => 18, 'status' => 0],
            ['id' => 19, 'name' => 'PaySense', 'logo' => '019.png', 'order_no' => 19, 'status' => 0],
            ['id' => 20, 'name' => 'Lendingkart', 'logo' => '023.png', 'order_no' => 20, 'status' => 0],
            ['id' => 21, 'name' => 'Indifi', 'logo' => '021.png', 'order_no' => 21, 'status' => 0],
            ['id' => 22, 'name' => 'Money View', 'logo' => '022.png', 'order_no' => 22, 'status' => 0],
            ['id' => 23, 'name' => 'Other Bank', 'logo' => '099.jpg', 'order_no' => 32, 'status' => 0],
            ['id' => 24, 'name' => 'Moneytap', 'logo' => '024.png', 'order_no' => 24, 'status' => 0],
            ['id' => 25, 'name' => 'IDFC First Bank', 'logo' => '025.png', 'order_no' => 25, 'status' => 0],
            ['id' => 26, 'name' => 'Bajaj Finserv', 'logo' => '026.png', 'order_no' => 26, 'status' => 0],
            ['id' => 28, 'name' => 'Ziploan', 'logo' => '028.png', 'order_no' => 28, 'status' => 0],
            ['id' => 29, 'name' => 'Credit Enable', 'logo' => '029.png', 'order_no' => 29, 'status' => 0],
            ['id' => 30, 'name' => 'Hero Fincorp', 'logo' => '030.png', 'order_no' => 30, 'status' => 0],
            ['id' => 31, 'name' => 'Monexo', 'logo' => '031.png', 'order_no' => 31, 'status' => 0],
            ['id' => 32, 'name' => 'NeoGrowth', 'logo' => '032.png', 'order_no' => 32, 'status' => 0],
            ['id' => 33, 'name' => 'Werize', 'logo' => '045.png', 'order_no' => 33, 'status' => 0],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('our_partners')->insertOrIgnore($chunk);
        }
    }
}
