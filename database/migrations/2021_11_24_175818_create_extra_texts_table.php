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
            $table->longText('faq_text');
            $table->string('cta');
            $table->longText('about_us_text');
            $table->string('about_us_image');
            $table->longText('team_text');
            $table->string('team_image');
            $table->longText('contact_text');
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
