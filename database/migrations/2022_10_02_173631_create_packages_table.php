<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->double('adult_price');
            $table->double('child_price');
            $table->double('infant_price');
            $table->string('capacity');
            $table->string('duration');
            $table->integer('category_id');
            $table->integer('city_id');
            $table->integer('activity_id');
            $table->longText('description');
            $table->integer('status')->default(1);
            $table->integer('seal')->default(0);
            $table->string('icon');
            $table->string('avatar');
            $table->longText('meta_title')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();            
            $table->longText('highlights')->nullable();
            $table->longText('full_description')->nullable();
            $table->longText('includes')->nullable();
            $table->longText('meeting_point')->nullable();
            $table->longText('important_information')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
