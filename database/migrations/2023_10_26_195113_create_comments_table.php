<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('uri'); // Primary Key
            $table->string('comment'); // Comment field
            $table->string('reference_no'); // Foreign Key
            $table->foreign('reference_no')->references('reference_no')->on('referrals');
            $table->timestamp('created_at')->useCurrent(); // Created timestamp
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
