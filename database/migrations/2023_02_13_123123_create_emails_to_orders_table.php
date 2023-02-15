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
        Schema::create('emails_to_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('email_id');
            $table->integer('user_id');
            $table->string('notes');



            // $table->foreignId('order_id')->constrained()->onDelete('cascade');
            // $table->foreignId('email_id')->constrained()->onDelete('cascade');
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('emails_to_orders');
    }
};
