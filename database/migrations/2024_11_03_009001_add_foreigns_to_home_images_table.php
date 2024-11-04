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
        Schema::table('home_images', function (Blueprint $table) {
            $table
                ->foreign('home_id')
                ->references('id')
                ->on('homes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_images', function (Blueprint $table) {
            $table->dropForeign(['home_id']);
        });
    }
};
