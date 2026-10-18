<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * One admin login for /webapp and one test customer for the OTP test phone (see config/web/sms.php).
 * Change the admin password after the first login.
 */
class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        if (!DB::table('users')->where('email', 'admin@fleshfin.in')->exists()) {
            DB::table('users')->insert([
                'uuid' => (string) Str::uuid(),
                'role' => 1,
                'name' => 'Admin',
                'phone' => '9999999999',
                'email' => 'admin@fleshfin.in',
                'password' => Hash::make('Admin@12345'),
                'status' => 1,
                'mobile_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $test_phone = (string) config('web.sms.otp.test_phone', '8866442200');
        if (!DB::table('users')->where('phone', $test_phone)->exists()) {
            DB::table('users')->insert([
                'uuid' => (string) Str::uuid(),
                'role' => 2,
                'name' => 'Demo Customer',
                'phone' => $test_phone,
                'email' => 'demo.customer@fleshfin.in',
                'status' => 1,
                'state_id' => DB::table('states')->where('name', 'Gujarat')->value('id'),
                'city' => 'Surat',
                'pincode' => '395002',
                'mobile_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
