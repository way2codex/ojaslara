<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreKeywordReplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_keyword_replace', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->nullable();
            $table->string('keyword')->nullable();
            $table->string('keyword_replace')->nullable();
            $table->string('status')->nullable()->default('active')->comment('active,inactve');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_keyword_replace');
    }
}
