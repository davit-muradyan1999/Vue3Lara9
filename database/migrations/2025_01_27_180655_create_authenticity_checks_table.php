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
        Schema::create('authenticity_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->index()->constrained('products');
            $table->string('barcode')->unique();
            $table->string('title')->nullable();
            $table->string('item')->nullable();
            $table->string('gold')->nullable();
            $table->string('silver')->nullable();
            $table->string('stone')->nullable();
            $table->string('other_materials')->nullable();
            $table->string('price_exclusive')->nullable();
            $table->string('handcrafted')->nullable();
            $table->string('exclusive_edition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authenticity_checks');
    }
};
