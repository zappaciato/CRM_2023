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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // 
            $table->string('surname'); // 
            $table->string('position'); // 
            $table->string('email'); // 
            $table->string('phone')->nullable(); // 
            $table->string('phone_business')->nullable(); // 
            $table->string('notes')->nullable(); // notatki
            // $table->integer('address_id')->unsigned()->nullable();
            // $table->integer('firms_id')->unsigned()->nullable();

            // $table->string('person_trade'); // os handlowa
            // $table->string('person_technical'); // os techniczna
            // $table->string('person_marketing'); // os marketingowa
            // $table->string('person_accountant'); // os księgowa
            // $table->string('person_from_the_board'); // os z zarzadu

            // $table->softDeletes(); // 

            //$table->primary('id');
            // $table->foreign('address_id')->references('id')->on('persons_address');
            // $table->foreign('firms_id')->references('id')->on('firms');

            $table->foreignId('company_id')->constrained()->onDelete('cascade'); //ta wersja zadziałała;

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
        Schema::dropIfExists('contacts');
    }
};
