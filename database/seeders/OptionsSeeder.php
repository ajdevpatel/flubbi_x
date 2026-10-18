<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `options` (4 rows), exported from the live schema. Safe to re-run. */
class OptionsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'key' => 'self_video', 'label' => 'Self Video', 'value' => 'https://youtube.com/shorts/5D0pH-HsMAI?si=yg_OuQQRaHVHmakh', 'status' => 0],
            ['id' => 2, 'key' => 'consultant_video', 'label' => 'Consultant Video', 'value' => 'https://youtube.com/shorts/H_SUBU3_bBQ?si=EdDfbE_yOrztZT9H', 'status' => 0],
            ['id' => 3, 'key' => 'support_mail', 'label' => 'Support Mail', 'value' => 'support@flubbi.com', 'status' => 0],
            ['id' => 4, 'key' => 'support_phone', 'label' => 'Support Phone', 'value' => '9876543210', 'status' => 0],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('options')->insertOrIgnore($chunk);
        }
    }
}
