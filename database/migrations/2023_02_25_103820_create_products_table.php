<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Product_name', 999);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('section_id');//nombre positive
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            //si on supprirme sectionid products de section id supprime
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
