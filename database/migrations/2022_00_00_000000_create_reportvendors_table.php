<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportvendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportvendors', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('complainant_id');
            $table->uuid('suspect_id');
            $table->text('message');
            $table->text('status')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table
                ->foreign('complainant_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table
                ->foreign('suspect_id')
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
        Schema::dropIfExists('reportvendors');
    }
}