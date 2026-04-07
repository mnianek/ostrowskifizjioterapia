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
        Schema::create('comment_reports', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('comment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->uuid('guest_token')->nullable();
            $table->string('reason', 255)->nullable();
            $table->timestamps();

            $table->index('comment_id');
            $table->index('user_id');
            $table->index('guest_token');
            $table->unique(['comment_id', 'user_id']);
            $table->unique(['comment_id', 'guest_token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_reports');
    }
};
