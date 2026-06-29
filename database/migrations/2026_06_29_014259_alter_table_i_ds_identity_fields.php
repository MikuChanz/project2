<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('i_ds', function (Blueprint $table) {
            $table->dropColumn('price');
        });

        Schema::table('i_ds', function (Blueprint $table) {
            $table->string('rarity', 3)->nullable()->after('description');
            $table->string('season', 64)->nullable()->after('rarity');
            $table->renameColumn('year', 'release_year');
        });
    }

    public function down(): void
    {
        Schema::table('i_ds', function (Blueprint $table) {
            $table->renameColumn('release_year', 'year');
            $table->dropColumn('rarity');
            $table->dropColumn('season');
        });

        Schema::table('i_ds', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable()->after('description');
        });
    }
};