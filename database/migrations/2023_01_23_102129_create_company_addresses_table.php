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


        Schema::create('company_addresses', function (Blueprint $table) {

            $table->id();
            $table->string('name'); // nazwa adresu
            $table->string('street')->nullable(); //
            $table->string('city'); // kraj
            $table->string('postal_code'); //
            $table->string('country');
            $table->string('province')->nullable(); // wojewodztwo

            // $table->unsignedBigInteger('company_id'); // czy w ogóle przypisane do czegokolwiek


            // $table->softDeletes(); //
            $table->timestamps();

            //$table->primary('id');
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); //ta wersja zadziałała;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_addresses');
    }
};
