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
        Schema::table('about_tagabout', function (Blueprint $table) {
            $table
                ->foreign('tagabout_id')
                ->references('id')
                ->on('tagabouts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('about_id')
                ->references('id')
                ->on('abouts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_tagabout', function (Blueprint $table) {
            $table->dropForeign(['tagabout_id']);
            $table->dropForeign(['about_id']);
        });
    }
};
