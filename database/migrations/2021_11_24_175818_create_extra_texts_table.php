<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_texts', function (Blueprint $table) {
            $table->id();
            $table->string('faq_title');
            $table->string('faq_text');
            $table->string('cta');
            $table->string('about_us_text');
            $table->string('about_us_image');
            $table->string('team_text');
            $table->string('team_image');
            $table->string('contact_text');
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
        Schema::dropIfExists('extra_texts');
    }
}
