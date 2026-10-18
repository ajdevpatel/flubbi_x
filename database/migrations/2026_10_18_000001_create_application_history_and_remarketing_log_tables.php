<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Generated from the live schema on 2026-10-18. Tables: application_history, remarketing_log
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE TABLE IF NOT EXISTS `application_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `application_id` int NOT NULL DEFAULT '0',
  `status_id` int NOT NULL DEFAULT '0',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
SQL);

        DB::statement(<<<'SQL'
CREATE TABLE IF NOT EXISTS `remarketing_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rec_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cron_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'company' COMMENT 'sms, whatsapp',
  `cronname` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `msgcount` int NOT NULL,
  `msgresponse` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci
SQL);
    }

    public function down(): void
    {
        Schema::dropIfExists('remarketing_log');
        Schema::dropIfExists('application_history');
    }
};
