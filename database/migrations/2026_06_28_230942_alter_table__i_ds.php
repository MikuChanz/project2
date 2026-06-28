<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('i_ds', function (Blueprint $table) {
            $table->foreign('sinner_id')
                ->references('id')
                ->on('sinners');
        });
    }
    
    public function down(): void
    {
        Schema::table('i_ds', function (Blueprint $table) {
            $table->dropForeign('i_ds_sinner_id_foreign');
        });
    }
};
