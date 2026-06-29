<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('i_ds', function (Blueprint $table) {
            $table->foreignId('association_id')->after('sinner_id');

            $table->foreign('association_id')
                ->references('id')
                ->on('associations');
        });
    }

    public function down(): void
    {
        Schema::table('i_ds', function (Blueprint $table) {
            $table->dropForeign('i_ds_association_id_foreign');
            $table->dropColumn('association_id');
        });
    }
};