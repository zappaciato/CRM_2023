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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->text('message_id')->nullable(); //
            $table->text('headers_raw')->nullable(); // 
            $table->text('headers')->nullable();
            $table->text('from_name')->nullable(); // 
            $table->text('from_address')->nullable(); // //
            $table->string('subject');
            $table->text('to')->nullable(); // 
            $table->text('to_string')->nullable(); // 
            $table->text('cc')->nullable(); // 
            $table->text('bcc')->nullable(); // notatki
            $table->text('reply_to')->nullable(); // 
            $table->longText('text_plain')->nullable(); // 
            $table->longText('text_html')->nullable();
            $table->integer('order_id')->nullable();

            // $table->integer('user_id')->unsigned()->nullable(); // osoba odpowiedzialna
            // $table->foreignId('order_id')->constrained()->onDelete('cascade'); //ta wersja zadziałała;
            // $table->foreign('user_id')->references('id')->on('users');


            $table->dateTime('date'); // data rozpoczęcia 
            $table->boolean('internal')->default(0);
            $table->softDeletes(); 
            $table->string('emailstatus');
            $table->timestamps();
        });


        Schema::create('emails_attachments', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name'); // 
            $table->text('file_path'); // 
            $table->text('disposition')->nullable(); // 
            $table->integer('emails_id')->unsigned()->nullable();
            $table->text('attachment_id')->nullable();

            $table->softDeletes(); // 
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
        Schema::dropIfExists('emails');
        Schema::dropIfExists('emails_attachments');
    }
};
