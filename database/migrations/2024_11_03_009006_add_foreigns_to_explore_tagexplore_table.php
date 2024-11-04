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
        Schema::table('explore_tagexplore', function (Blueprint $table) {
            $table
                ->foreign('tagexplore_id')
                ->references('id')
                ->on('tagexplores')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

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
        Schema::table('explore_tagexplore', function (Blueprint $table) {
            $table->dropForeign(['tagexplore_id']);
            $table->dropForeign(['explore_id']);
        });
    }
};
