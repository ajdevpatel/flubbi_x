<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Fresh install: php artisan migrate --seed
 * Every seeder uses insertOrIgnore, so re-running is safe.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LoanTypesSeeder::class,
            LoanStatusSeeder::class,
            LoanPurposesSeeder::class,
            CibilScoresSeeder::class,
            SupportReasonsSeeder::class,
            StatesSeeder::class,
            DistrictsSeeder::class,
            BanksSeeder::class,
            SelfLoginBanksSeeder::class,
            OurPartnersSeeder::class,
            OptionsSeeder::class,
            WebOptionsSeeder::class,
            DemoUsersSeeder::class,
        ]);
    }
}
