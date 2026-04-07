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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('post_id')
                ->constrained('comments')
                ->nullOnDelete();
            $table->boolean('is_pinned')->default(false)->after('is_approved');

            $table->index(['post_id', 'is_pinned']);
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['post_id', 'is_pinned']);
            $table->dropIndex(['parent_id']);
            $table->dropConstrainedForeignId('parent_id');
            $table->dropColumn('is_pinned');
        });
    }
};
