<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Master data for `web_options` (12 rows), exported from the live schema. Safe to re-run. */
class WebOptionsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'uuid' => 'cb2523e1-cc14-41e1-a2da-30ba90edc949', 'op_group' => 'google', 'op_label' => 'google domain verification', 'op_key' => 'google_domain_verification', 'op_value' => '#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 12, 'updated_at' => '2026-02-15 10:14:41'],
            ['id' => 2, 'uuid' => 'e4f37ae4-0008-4799-bded-fb31c92ba1ab', 'op_group' => 'google', 'op_label' => 'google analytics', 'op_key' => 'google_analytics', 'op_value' => 'G-#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 3, 'uuid' => 'f8125572-782b-4921-b36a-a6ca25dd3bc5', 'op_group' => 'google', 'op_label' => 'google tag manager', 'op_key' => 'google_tag_manager', 'op_value' => 'GTM-#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 4, 'uuid' => 'd64357b3-ad1c-4d21-a600-482ecc50a63d', 'op_group' => 'pinterest', 'op_label' => 'Pinterest Domain Verification', 'op_key' => 'pinterest_domain_verification', 'op_value' => '##', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 12, 'updated_at' => '2026-02-15 10:14:01'],
            ['id' => 5, 'uuid' => 'dafbbd5c-75fb-4048-b283-bea05c578ad6', 'op_group' => '2factor', 'op_label' => '2factor OTP SMS Auth Key', 'op_key' => 'twofactor_otp_sms_auth_key', 'op_value' => '#-ce76-11ef-8b17-0200cd936042', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 6, 'uuid' => '238d5c7c-4f43-4b18-86e0-d168597193af', 'op_group' => 'facebook', 'op_label' => 'Facebook Domain Verification', 'op_key' => 'facebook_domain_verification', 'op_value' => '#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 7, 'uuid' => 'e22aeb0c-5b66-4f72-8b0b-c4be7d9d3f6f', 'op_group' => 'facebook', 'op_label' => 'Facebook Pixel Key', 'op_key' => 'facebook_pixel_key', 'op_value' => '#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 8, 'uuid' => 'b8e26014-cd3c-4b4d-8d1c-f3ed5b151e67', 'op_group' => 'facebook', 'op_label' => 'Facebook Event Name', 'op_key' => 'facebook_event_name', 'op_value' => 'Purchase', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 12, 'updated_at' => '2026-02-15 10:13:53'],
            ['id' => 9, 'uuid' => 'b14bfc5d-628f-47f8-99fd-b093b23f5b6e', 'op_group' => 'facebook', 'op_label' => 'Facebook Event Id', 'op_key' => 'facebook_event_id', 'op_value' => '#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 10, 'uuid' => '3ad1ba1e-d550-4a29-9db0-e982aad3b65d', 'op_group' => 'facebook', 'op_label' => 'Facebook Access Token', 'op_key' => 'facebook_access_token', 'op_value' => '#', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2025-02-12 10:39:47'],
            ['id' => 11, 'uuid' => '3ad1ba1e-d550-4a29-9db0-e982aad3b65e', 'op_group' => 'sms', 'op_label' => 'Remarketing SMS', 'op_key' => 'remarketing_sms', 'op_value' => 'Your Pre-Approved Rs.<#preamount>/- Loan Offer is Confirmed. Get Money in Your A/C 5 min. Apply Now https://flubbi.in', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2026-03-16 07:10:29'],
            ['id' => 12, 'uuid' => '4ad1ba1e-d550-4a29-9db0-f982aad3b65f', 'op_group' => 'sms', 'op_label' => 'Subscription Account SMS', 'op_key' => 'subscription_account_sms', 'op_value' => 'Your Pre-Approved Rs.<#preamount>/- Loan Offer is Confirmed. Get Money in Your A/C 5 min. Apply Now https://flubbi.in', 'note' => null, 'priority' => 0, 'status' => '0', 'deleted' => '0', 'updated_by' => 0, 'updated_at' => '2026-09-20 23:11:23'],
        ];

        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('web_options')->insertOrIgnore($chunk);
        }
    }
}
