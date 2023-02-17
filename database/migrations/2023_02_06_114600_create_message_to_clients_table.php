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
        Schema::create('message_to_clients', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->string('cc')->nullable();
            $table->string('subject');
            $table->longText('content')->nullable();


            $table->timestamps();


            $table->foreignId('order_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_to_clients');
    }
};
