<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInfoHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_home', function (Blueprint $table) {
            $table->id();
            $table->string('title_seo')->nullable();
            $table->longText('description_seo')->nullable();
            $table->string('tag_banner')->nullable();
            $table->string('title_banner')->nullable();
            $table->longText('subtitle_banner')->nullable();
            $table->string('img_banner')->nullable();
            $table->string('title_como_funciona')->nullable();
            $table->string('title_cf1')->nullable();
            $table->longText('subtitle_cf1')->nullable();
            $table->string('title_cf2')->nullable();
            $table->longText('subtitle_cf2')->nullable();
            $table->string('title_cf3')->nullable();
            $table->longText('subtitle_cf3')->nullable();
            $table->string('title_cf4')->nullable();
            $table->longText('subtitle_cf4')->nullable();
            $table->string('title_cf5')->nullable();
            $table->longText('subtitle_cf5')->nullable();
            $table->string('title_about')->nullable();
            $table->string('subtitle_about')->nullable();
            $table->longText('txt_about')->nullable();
            $table->string('img_about')->nullable();
            $table->string('title_pet')->nullable();
            $table->string('subtitle_pet')->nullable();
            $table->string('img_pet')->nullable();
            $table->string('title_blog')->nullable();
            $table->string('subtitle_blog')->nullable();
            $table->string('title_depoimentos')->nullable();
            $table->string('subtitle_depoimentos')->nullable();
            $table->string('title_faq')->nullable();
            $table->string('subtitle_faq')->nullable();
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
        Schema::dropIfExists('info_home');
    }
}
