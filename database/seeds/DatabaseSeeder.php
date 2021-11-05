<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 records of companies
        factory(App\Company::class, 10)->create()->each(function ($company) {
            
            // Seed the relation with 5 employees
            $employee = factory(App\Employee::class, 5)->make();
            $company->employee()->saveMany($employee);

        });

         // Create 10 records of users
        factory(App\User::class, 10)->create();

    }
}
