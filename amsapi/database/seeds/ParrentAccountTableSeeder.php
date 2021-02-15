<?php

use Illuminate\Database\Seeder;

class ParrentAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Account\ParentAccount::class,5)->create();
    }
}
