<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToReferenceNoColumnInReferrals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->index('reference_no'); // Add an index to the reference_no column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    

    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropIndex('referrals_reference_no_index'); // Drop the index
        });
    }
}
