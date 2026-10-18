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
        if (!Schema::hasColumn('users', 'is_dnd')) {
            Schema::table('users', fn (Blueprint $t) => $t->tinyInteger('is_dnd')->default(0)->after('status'));
        }
        if (!Schema::hasColumn('users', 'dnd_at')) {
            Schema::table('users', fn (Blueprint $t) => $t->timestamp('dnd_at')->nullable()->after('is_dnd'));
        }
    }

    public function down(): void
    {
        // intentionally left blank
    }
};
