<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('package_tagpackage', function (Blueprint $table) {
            $table
                ->foreign('tagpackage_id')
                ->references('id')
                ->on('tagpackages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_tagpackage', function (Blueprint $table) {
            $table->dropForeign(['tagpackage_id']);
            $table->dropForeign(['package_id']);
        });
    }
};
