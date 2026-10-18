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
        if (!Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', fn (Blueprint $t) => $t->timestamp('deleted_at')->nullable());
        }
    }

    public function down(): void
    {
        // intentionally left blank
    }
};
