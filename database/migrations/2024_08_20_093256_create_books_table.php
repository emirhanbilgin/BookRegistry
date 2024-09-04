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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id')->constrained('authors'); // authors tablosuna bağlantı
            $table->string('isbn')->unique();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('author'); // Gereksiz 'author' sütununu kaldır
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author'); // Rollback durumunda 'author' sütununu geri ekle
        });

        Schema::dropIfExists('books');
    }
};
