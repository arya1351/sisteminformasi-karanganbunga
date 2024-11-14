<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id'); 
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->integer('qty');
            $table->bigInteger('total_price');
            $table->enum('status', ['unpaid', 'paid']);
            $table->string('no_resi')->nullable();
            $table->enum('selling', ['waiting','progress', 'finish'])->default('waiting');
            $table->timestamps();
            $table->foreign(columns: 'produk_id')->references('id')->on('produk')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
