<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertIntoPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //investors
        DB::table("permissions")->insert([
            ["key" => "show_investors", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_investors", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_investors", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_investors", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //clients
        DB::table("permissions")->insert([
            ["key" => "show_clients", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_clients", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_clients", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_clients", "table_name" => "users", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //financial_transactions
        DB::table("permissions")->insert([
            ["key" => "show_financial_transactions", "table_name" => "financial_transactions", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_financial_transactions", "table_name" => "financial_transactions", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_financial_transactions", "table_name" => "financial_transactions", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_financial_transactions", "table_name" => "financial_transactions", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //contracts
        DB::table("permissions")->insert([
            ["key" => "show_contracts", "table_name" => "contracts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_contracts", "table_name" => "contracts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_contracts", "table_name" => "contracts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_contracts", "table_name" => "contracts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //store&&user_products
        DB::table("permissions")->insert([
            ["key" => "show_user_products", "table_name" => "product_user", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_user_products", "table_name" => "product_user", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_user_products", "table_name" => "product_user", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_user_products", "table_name" => "product_user", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //products
        DB::table("permissions")->insert([
            ["key" => "show_products", "table_name" => "products", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_products", "table_name" => "products", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_products", "table_name" => "products", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_products", "table_name" => "products", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //company_accounts
        DB::table("permissions")->insert([
            ["key" => "show_accounts", "table_name" => "company_accounts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_accounts", "table_name" => "company_accounts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_accounts", "table_name" => "company_accounts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_accounts", "table_name" => "company_accounts", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

        //groups
        DB::table("permissions")->insert([
            ["key" => "show_groups", "table_name" => "groups", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_groups", "table_name" => "groups", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_groups", "table_name" => "groups", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_groups", "table_name" => "groups", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

         //prints
        DB::table("permissions")->insert([
            ["key" => "show_prints", "table_name" => "print_templates", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_prints", "table_name" => "print_templates", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_prints", "table_name" => "print_templates", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "do_prints", "table_name" => "print_templates", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_prints", "table_name" => "print_templates", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

          //Collections
        DB::table("permissions")->insert([

            ["key" => "show_collections", "table_name" => "collections", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "create_collections", "table_name" => "collections", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "edit_collections", "table_name" => "collections", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ["key" => "delete_collections", "table_name" => "collections", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Collections
        DB::table("permissions")
            ->where("key", "show_collections")
            ->where("key", "create_collections")
            ->orWhere("key", "edit_collections")
            ->orWhere("key", "delete_collections")
            ->delete();

        //prints
        DB::table("permissions")
            ->where("key", "show_prints")
            ->where("key", "do_prints")
            ->where("key", "create_prints")
            ->orWhere("key", "edit_prints")
            ->orWhere("key", "delete_prints")
            ->delete();

        //groups
        DB::table("permissions")
            ->where("key", "show_groups")
            ->where("key", "create_groups")
            ->orWhere("key", "edit_groups")
            ->orWhere("key", "delete_groups")
            ->delete();

        //company_accounts
        DB::table("permissions")
            ->where("key", "create_accounts")
            ->orWhere("key", "edit_accounts")
            ->orWhere("key", "delete_accounts")
            ->delete();

        //products
        DB::table("permissions")
            ->where("key", "create_products")
            ->orWhere("key", "edit_products")
            ->orWhere("key", "delete_products")
            ->delete();

        //store
        DB::table("permissions")
            ->where("key", "create_user_products")
            ->orWhere("key", "edit_user_products")
            ->orWhere("key", "delete_user_products")
            ->delete();

        //contracts
        DB::table("permissions")
            ->where("key", "create_contracts")
            ->orWhere("key", "edit_contracts")
            ->orWhere("key", "delete_contracts")
            ->delete();

        //financial_transactions
        DB::table("permissions")
            ->where("key", "create_financial_transactions")
            ->orWhere("key", "edit_financial_transactions")
            ->orWhere("key", "delete_financial_transactions")
            ->delete();

        //clients
        DB::table("permissions")
            ->where("key", "create_clients")
            ->orWhere("key", "edit_clients")
            ->orWhere("key", "delete_clients")
            ->delete();

        //investors
        DB::table("permissions")
            ->where("key", "create_investors")
            ->orWhere("key", "edit_investors")
            ->orWhere("key", "delete_investors")
            ->delete();
    }
}
