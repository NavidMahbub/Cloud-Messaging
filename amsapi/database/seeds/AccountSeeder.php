<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('accounts')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $data = Faker\Factory::create();
        
            DB::table('accounts')->insert([
                'id' => 1,
                'name' => 'Advance Tax',
                'code' => 'Advance Tax',
                'description' => 'Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('accounts')->insert([
                'id' => 2,
                'name' => 'Employee Advance',
                'code' => 'Employee Advance',
                'description' => 'Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('accounts')->insert([
                'id' => 3,
                'name' => 'Petty Cash',
                'code' => 'Petty Cash',
                'description' => 'It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 4,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('accounts')->insert([
                'id' => 4,
                'name' => 'Undeposited Funds',
                'code' => 'Undeposited Funds',
                'description' => 'Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 4,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            

            DB::table('accounts')->insert([
                'id' => 5,
                'name' => 'Accounts Receivable',
                'code' => 'Accounts Receivable',
                'description' => 'The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('accounts')->insert([
                'id' => 6,
                'name' => 'Inventory Asset',
                'code' => 'Inventory Asset',
                'description' => 'An account which tracks the value of goods in your inventory.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 7,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('accounts')->insert([
                'id' => 7,
                'name' => 'Opening Balance Adjustments',
                'code' => 'Opening Balance Adjustments',
                'description' => 'This account will hold the difference in the debits and credits entered during the opening balance.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 9,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 8,
                'name' => 'Employee Reimbursements',
                'code' => 'Employee Reimbursements',
                'description' => 'This account can be used to track the reimbursements that are due to be paid out to employees.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 9,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 9,
                'name' => 'Tax Payable',
                'code' => 'Tax Payable',
                'description' => 'The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 9,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 10,
                'name' => 'Unearned Revenue',
                'code' => 'Unearned Revenue',
                'description' => 'A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 9,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('accounts')->insert([
                'id' => 11,
                'name' => 'Accounts Payable',
                'code' => 'Accounts Payable',
                'description' => 'This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 13,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 12,
                'name' => 'Tag Adjustments',
                'code' => 'Tag Adjustments',
                'description' => 'This adjustment account tracks the transfers between different reporting tags.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 12,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('accounts')->insert([
                'id' => 13,
                'name' => 'Drawings',
                'code' => 'Drawings',
                'description' => 'The money withdrawn from a business by its owner can be tracked with this account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 14,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 14,
                'name' => 'Opening Balance Offset',
                'code' => 'Opening Balance Offset',
                'description' => 'This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 14,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 15,
                'name' => 'Owner Equity',
                'code' => 'Owner Equity',
                'description' => 'The owners rights to the assets of a company can be quantified in the owner\'s equity account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 14,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('accounts')->insert([
                'id' => 16,
                'name' => 'Sales',
                'code' => 'Sales',
                'description' => 'The income from the sales in your business is recorded under the sales account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 17,
                'name' => 'General Income',
                'code' => 'General Income',
                'description' => 'A general category of account where you can record any income which cannot be recorded into any other category.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 18,
                'name' => 'Other Charges',
                'code' => 'Other Charges',
                'description' => 'Miscellaneous charges like adjustments made to the invoice can be recorded in this account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 19,
                'name' => 'Interest Income',
                'code' => 'Interest Income',
                'description' => 'A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 20,
                'name' => 'Shipping Charge',
                'code' => 'Shipping Charge',
                'description' => 'Shipping charges made to the invoice will be recorded in this account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 21,
                'name' => 'Discount',
                'code' => 'Discount',
                'description' => 'Any reduction on your selling price as a discount can be recorded into the discount account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 22,
                'name' => 'Late Fee Income',
                'code' => 'Late Fee Income',
                'description' => 'Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 15,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 23,
                'name' => 'Other Expenses',
                'code' => 'Other Expenses',
                'description' => 'Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 17,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 24,
                'name' => 'Bad Debt',
                'code' => 'Bad Debt',
                'description' => 'Any amount which is lost and is unrecoverable is recorded into the bad debt account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 17,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('accounts')->insert([
                'id' => 25,
                'name' => 'Exchange Gain or Loss',
                'code' => 'Exchange Gain or Loss',
                'description' => 'Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 19,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('accounts')->insert([
                'id' => 26,
                'name' => 'Cost of Goods Sold',
                'code' => 'Cost of Goods Sold',
                'description' => 'An expense account which tracks the value of the goods sold.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 18,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('accounts')->insert([
                'id' => 27,
                'name' => 'Prepaid Expense',
                'code' => 'Prepaid Expense',
                'description' => 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('accounts')->insert([
                'id' => 28,
                'name' => 'Bank 1',
                'code' => 'Bank',
                'description' => 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 5,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
            DB::table('accounts')->insert([
                'id' => 29,
                'name' => 'Bank 2',
                'code' => 'Bank',
                'description' => 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 5,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
            DB::table('accounts')->insert([
                'id' => 30,
                'name' => 'Agent Commission',
                'code' => 'Agent Commission',
                'description' => 'Agent Commission.',
                'dashboard_watchlist' => 0,
                'required' => 1,
                'account_type_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
    }
}
