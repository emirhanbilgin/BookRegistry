<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookstores', function (Blueprint $table) {
            $table->string('name')->after('id'); // 'name' sütununu ekler
        });
    }

    public function down()
    {
        Schema::table('bookstores', function (Blueprint $table) {
            $table->dropColumn('name'); // Rollback için 'name' sütununu kaldırır
        });
    }
};
