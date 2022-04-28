<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInfoContato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_contato', function (Blueprint $table) {
            $table->id();
            $table->string('title_seo')->nullable();
            $table->longText('description_seo')->nullable();
            $table->string('title_banner')->nullable();
            $table->string('img_banner')->nullable();
            $table->string('title_info')->nullable();
            $table->string('subtitle_info')->nullable();
            $table->string('title_form')->nullable();
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
        Schema::dropIfExists('info_contato');
    }
}
