<?php

use App\Models\Company;
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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            
            // $table->unsignedBigInteger('company_id');
            // $table->unsignedBigInteger('email_id');
            // $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('code');
            $table->string('contact_person');
            $table->string('address');
            $table->string('lead_person');
            $table->string('involved_person');
            $table->string('priority');
            $table->longText('order_content');
            $table->string('order_notes');
            
            $table->string('deadline');
            $table->string('status');
            // $table->enum('status', ['new', 'open', 'finished']);
            $table->timestamps();

            // $table->foreign('company_id')->references('id')->on('companies');
            // $table->foreign('email_id')->references('id')->on('emails');

            $table->foreignId('company_id')->constrained()->onDelete('cascade'); //ta wersja zadziałała;
            $table->foreignId('email_id')->constrained()->onDelete('cascade'); //ta wersja zadziałała;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
