<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('whatsapp_messages', function (Blueprint $table) {
            $table->string('direction', 8)->default('in')->index();
            $table->text('ai_draft')->nullable();
            $table->string('ai_model', 64)->nullable();
            $table->string('draft_token', 32)->nullable()->unique();
            $table->timestamp('auto_send_at')->nullable()->index();
            $table->timestamp('clicked_at')->nullable();
            $table->timestamp('auto_sent_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('whatsapp_messages', function (Blueprint $table) {
            $table->dropColumn(['direction', 'ai_draft', 'ai_model', 'draft_token', 'auto_send_at', 'clicked_at', 'auto_sent_at']);
        });
    }
};
