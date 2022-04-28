<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInfoParceiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_parceiro', function (Blueprint $table) {
            $table->id();
            $table->string('title_seo')->nullable();
            $table->longText('description_seo')->nullable();
            $table->string('title_banner')->nullable();
            $table->longText('subtitle_banner')->nullable();
            $table->string('img_banner')->nullable();
            
            $table->string('title_numeros')->nullable();
            $table->string('title_numero1')->nullable();
            $table->string('subtitle_numero1')->nullable();
            $table->string('title_numero2')->nullable();
            $table->string('subtitle_numero2')->nullable();
            $table->string('title_numero3')->nullable();
            $table->string('subtitle_numero3')->nullable();
            
            $table->string('title_about')->nullable();
            $table->string('subtitle_about')->nullable();
            $table->longText('txt_about')->nullable();
            $table->string('img_about')->nullable();
            
            $table->string('title_diferenciais')->nullable();
            $table->longText('subtitle_diferenciais')->nullable();
            $table->string('title_diferencial1')->nullable();
            $table->string('subtitle_diferencial1')->nullable();
            $table->string('title_diferencial2')->nullable();
            $table->string('subtitle_diferencial2')->nullable();
            $table->string('title_diferencial3')->nullable();
            $table->string('subtitle_diferencial3')->nullable();
            
            $table->string('title_depoimentos')->nullable();
            $table->string('subtitle_depoimentos')->nullable();
            
            $table->string('title_cta')->nullable();
            $table->longText('subtitle_cta')->nullable();
            $table->string('img_cta')->nullable();
            
            $table->string('title_form')->nullable();
            $table->string('subtitle_form')->nullable();

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
        Schema::dropIfExists('info_parceiro');
    }
}
