<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketofvendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketofvendors', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('market_id');
            $table->uuid('user_id');
            $table->integer('sales')->default(0);
            $table->decimal('rating', 9, 1)->default(0);
            $table->timestamps();

            $table->primary('id');
            $table
                ->foreign('market_id')
                ->references('id')
                ->on('markets')
                ->onDelete('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketofvendors');
    }
}