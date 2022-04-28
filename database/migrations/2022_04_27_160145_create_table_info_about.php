<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInfoAbout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_about', function (Blueprint $table) {
            $table->id();
            $table->string('title_seo')->nullable();
            $table->longText('description_seo')->nullable();
            $table->string('title_banner')->nullable();
            $table->string('img_banner')->nullable();
            $table->longText('txt_about')->nullable();
            $table->string('img_about')->nullable();
            $table->string('title_equipe')->nullable();
            $table->longText('txt_equipe')->nullable();
            $table->string('img_equipe')->nullable();
            $table->string('title_parceiros')->nullable();
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
        Schema::dropIfExists('info_about');
    }
}
