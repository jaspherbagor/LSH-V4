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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accommodation_type_id');
            $table->string('name'); // Name of the accommodation (e.g., Bayangan Hotel, Casie Hotel)
            $table->text('photo');
            $table->text('address');
            $table->text('contact_number')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('map')->nullable();
            $table->timestamps(); 
            // Define foreign key constraint
            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
};
