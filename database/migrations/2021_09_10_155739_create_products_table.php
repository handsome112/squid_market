<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('seller_id');
            $table->uuid('category_id')->nullable();
            $table->string('name');
            $table->string('type');
            $table->longtext('image');
            $table->text('description');
            $table->text('conditions');
            $table->decimal('quantity')->default(0.01);
            $table->decimal('price')->default(0.01);
            $table->enum('currency', array_keys(config('currencies')));
            $table->text('ships_price')->nullable();
            $table->text('paymethod')->default('escrow');
            $table->text('paytype')->default('xmr');
            $table->boolean('autofilled')->default(false);
            $table->text('digitalasset')->nullable();
            $table->string('mesure');
            $table->text('refund_policy')->nullable();
            $table->text('deliveryinfo')->nullable();
            $table
                ->enum('ships_from', array_keys(config('countries')))
                ->nullable();
            $table
                ->enum('ships_to', array_keys(config('countries')))
                ->nullable();
            $table->text('ships_time')->nullable();
            $table->text('ships_with')->nullable();
            $table->string('bid_monero_wallet')->nullable();
            $table->boolean('deleted')->default(false);
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->primary('id');
            $table
                ->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}