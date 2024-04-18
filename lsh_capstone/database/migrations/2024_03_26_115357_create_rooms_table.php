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
        
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accommodation_id'); // Foreign key for accommodation
            $table->text('room_name');
            $table->text('description');
            $table->text('price');
            $table->text('total_rooms');
            $table->text('amenities')->nullable();
            $table->text('size')->nullable();
            $table->text('total_beds')->nullable();
            $table->text('total_bathrooms')->nullable();
            $table->text('total_balconies')->nullable();
            $table->text('total_guests')->nullable();
            $table->text('featured_photo');
            $table->text('video_id')->nullable();
            $table->timestamps();
            
            // Define foreign key constraint
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
