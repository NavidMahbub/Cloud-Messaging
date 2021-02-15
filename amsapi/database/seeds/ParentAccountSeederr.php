<?php

use Illuminate\Database\Seeder;

class ParentAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('parent_accounts')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $data = Faker\Factory::create();
        DB::table('parent_accounts')->insert([
            'id' => 1,
            'name' => 'Assets',
            'description' => 'Assets',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_accounts')->insert([
            'id' => 2,
            'name' => 'Liability',
            'description' => 'Liability',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_accounts')->insert([
            'id' => 3,
            'name' => 'Equity',
            'description' => 'Equity',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_accounts')->insert([
            'id' => 4,
            'name' => 'Income',
            'description' => 'income',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_accounts')->insert([
            'id' => 5,
            'name' => 'Expense',
            'description' => 'Expense',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
