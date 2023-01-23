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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            // $table->string('created_by');
            $table->string('name');
            $table->integer('nip');
            $table->string('email');
            $table->string('phone');
            $table->string('phone_stationary')->nullable(); //
            $table->string('country');

            $table->string('www');
            $table->text('notes');
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
        Schema::dropIfExists('companies');
    }
};
