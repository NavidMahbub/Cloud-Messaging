<?php

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('account_types')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $data = Faker\Factory::create();
        
        // Assets accounts 
            DB::table('account_types')->insert([
                'id' => 1,
                'name' => 'Other Asset',
                'description' => 'Track special assets like goodwill and other intangible assets',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 2,
                'name' => 'Accounts Receivable',
                'description' => 'Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices',
                'parent_account_id' => 1,
                'required' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 3,
                'name' => 'Other Current asset',
                'description' => 'Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 4,
                'name' => 'Cash',
                'description' => 'To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 5,
                'name' => 'Bank',
                'description' => 'To keep track of bank accounts like Savings, Checking, and Money Market accounts',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 6,
                'name' => 'Fixed asset',
                'description' => 'Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 7,
                'name' => 'Stock',
                'description' => 'To keep track of your inventory assets.',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 8,
                'name' => 'Stock',
                'description' => 'To keep track of your inventory assets.',
                'parent_account_id' => 1,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            // liability accounts 

            DB::table('account_types')->insert([
                'id' => 9,
                'name' => 'Other Current Liability',
                'description' => 'Any short term liability like:Customer Deposits - Tax Payable',
                'parent_account_id' => 2,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 10,
                'name' => 'Credit Card',
                'description' => 'Create a trail of all your credit card transactions by creating a credit card account',
                'parent_account_id' => 2,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 11,
                'name' => 'Long Term Liability',
                'description' => 'Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans',
                'parent_account_id' => 2,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('account_types')->insert([
                'id' => 12,
                'name' => 'Other Liability',
                'description' => 'Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc',
                'parent_account_id' => 2,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 13,
                'name' => 'Accounts Payable',
                'description' => 'Accounts Payable',
                'parent_account_id' => 2,
                'required' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            // Equity accounts

            DB::table('account_types')->insert([
                'id' => 14,
                'name' => 'Equity',
                'description' => 'Equity',
                'parent_account_id' => 3,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            //income accounts 

            DB::table('account_types')->insert([
                'id' => 15,
                'name' => 'income',
                'description' => 'income',
                'parent_account_id' => 4,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('account_types')->insert([
                'id' => 16,
                'name' => 'Other Income',
                'description' => 'Other Income',
                'parent_account_id' => 4,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            // expense accounts

            DB::table('account_types')->insert([
                'id' => 17,
                'name' => 'Expense',
                'description' => 'Expense',
                'parent_account_id' => 5,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 18,
                'name' => 'Cost of Goods Sold',
                'description' => 'Cost of Goods Sold',
                'parent_account_id' => 5,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_types')->insert([
                'id' => 19,
                'name' => 'Other Expense',
                'description' => 'Other Expense',
                'parent_account_id' => 5,
                'required' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
    }
}
