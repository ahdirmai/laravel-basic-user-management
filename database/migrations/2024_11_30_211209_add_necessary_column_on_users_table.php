<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('nik')->nullable();
            $table->string('npwpd')->nullable();
            $table->string('nohp')->nullable();
            $table->string('fotopengguna')->nullable();
            $table->boolean('statusaktif')->default(1);
            $table->boolean('statuslogin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nik');
            $table->dropColumn('npwpd');
            $table->dropColumn('nohp');
            $table->dropColumn('fotopengguna');
            $table->dropColumn('statusaktif');
            $table->dropColumn('statuslogin');
        });
    }
};
