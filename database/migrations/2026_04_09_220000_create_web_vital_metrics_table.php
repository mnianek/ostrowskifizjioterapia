<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_vital_metrics', function (Blueprint $table): void {
            $table->id();
            $table->string('metric', 16);
            $table->float('value');
            $table->string('rating', 16)->nullable();
            $table->string('path')->nullable();
            $table->string('session_token', 64)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['metric', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_vital_metrics');
    }
};
