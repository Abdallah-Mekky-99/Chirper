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
        Schema::table('likes', function (Blueprint $table) {
            // Because SQLite schema updates can fail halfway, we add checks to make this idempotent
            if (Schema::hasColumn('likes', 'chirp_id')) {
                $table->dropUnique(['user_id', 'chirp_id']);
                $table->dropForeign(['chirp_id']);
                $table->renameColumn('chirp_id', 'likable_id');
            }

            if (!Schema::hasColumn('likes', 'likable_type')) {
                $table->string('likable_type')->default('App\Models\Chirp');
            }
        });

        Schema::table('likes', function (Blueprint $table) {
            // In SQLite, adding complex indexes should be done in a separate block
            // Check if the index already exists to prevent errors
            $indexes = Schema::getIndexes('likes');
            $indexExists = false;
            foreach ($indexes as $index) {
                if ($index['name'] === 'likes_user_likable_unique') {
                    $indexExists = true;
                    break;
                }
            }
            
            if (!$indexExists) {
                $table->unique(['user_id', 'likable_id', 'likable_type'], 'likes_user_likable_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropUnique('likes_user_likable_unique');
            
            $table->dropColumn('likable_type');
            
            $table->renameColumn('likable_id', 'chirp_id');
            
            // Re-add the foreign key constraint
            $table->foreign('chirp_id')->references('id')->on('chirps')->cascadeOnDelete();
            
            // Re-add the original unique constraint
            $table->unique(['user_id', 'chirp_id']);
        });
    }
};
