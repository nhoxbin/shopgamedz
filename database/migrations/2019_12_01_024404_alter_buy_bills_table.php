<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBuyBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buy_bills', function($table) {
            $table->boolean('require_cancel')->default(0)->after('name_character');
            $table->string('picture_to_confirm')->after('require_cancel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_bills', function (Blueprint $table) {
            $table->dropColumn('require_cancel');
            $table->dropColumn('picture_to_confirm');
        });
    }
}
