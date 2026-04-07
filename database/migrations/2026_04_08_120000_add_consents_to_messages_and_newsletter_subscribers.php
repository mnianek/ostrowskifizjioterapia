<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table): void {
            $table->boolean('privacy_consent')->default(false)->after('content');
            $table->timestamp('privacy_consent_at')->nullable()->after('privacy_consent');
            $table->string('privacy_consent_ip', 45)->nullable()->after('privacy_consent_at');
        });

        Schema::table('newsletter_subscribers', function (Blueprint $table): void {
            $table->boolean('privacy_consent')->default(false)->after('email');
            $table->timestamp('privacy_consent_at')->nullable()->after('privacy_consent');
            $table->string('privacy_consent_ip', 45)->nullable()->after('privacy_consent_at');
        });
    }

    public function down(): void
    {
        Schema::table('newsletter_subscribers', function (Blueprint $table): void {
            $table->dropColumn(['privacy_consent', 'privacy_consent_at', 'privacy_consent_ip']);
        });

        Schema::table('messages', function (Blueprint $table): void {
            $table->dropColumn(['privacy_consent', 'privacy_consent_at', 'privacy_consent_ip']);
        });
    }
};
