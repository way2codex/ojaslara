<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('category_id')->nullable()->default(0);
            $table->string('website')->nullable();
            $table->string('website_url')->nullable();
            $table->string('is_rewrite')->default('false');
            $table->string('data_fetch_mode')->default('auto')->comment('auto,manual');
            $table->string('data_fetch_type')->default('latest')->comment('latest,old,both');
            $table->integer('total_data_count')->nullable()->default(0);
            $table->string('freq')->default('')->nullable()->comment('minutes');
            $table->integer('last_freq_data_count')->nullable()->default(0);
            $table->integer('total_freq_completed_count')->nullable()->default(0);
            $table->dateTime('last_freq_completed')->nullable();
            $table->dateTime('next_freq')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('inactive')->comment('active,inactive')->nullable();
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
        Schema::dropIfExists('store');
    }
}
