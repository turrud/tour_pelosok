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
        Schema::table('explore_images', function (Blueprint $table) {
            $table
                ->foreign('explore_id')
                ->references('id')
                ->on('explores')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('explore_images', function (Blueprint $table) {
            $table->dropForeign(['explore_id']);
        });
    }
};
