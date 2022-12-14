<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_requests', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('admin_id')->nullable();
            $table->text('title');
            $table->text('status')->default('opened');
            $table->timestamps();

            $table->primary('id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table
                ->foreign('admin_id')
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
        Schema::dropIfExists('help_requests');
    }
}