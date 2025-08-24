<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('qty')->default(1)->after('products_id');
        });
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->integer('qty')->default(1)->after('products_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
    }
};
