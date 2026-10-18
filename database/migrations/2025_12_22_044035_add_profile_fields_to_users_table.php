<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Generated from the live schema on 2026-10-18. Tables: none (column tweaks)
 */
return new class extends Migration
{
    public function up(): void
    {
        // Profile columns (dob, gender, state_id, city_id, city, pan_card, pincode, address, fcm_token, profile_pic)
        // are part of the users table definition in 0001_01_01_000000_create_users_table. Nothing to do here.
    }

    public function down(): void
    {
        // intentionally left blank
    }
};
