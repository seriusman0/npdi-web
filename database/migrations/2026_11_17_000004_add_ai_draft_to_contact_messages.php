<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->text('ai_draft')->nullable()->after('message');
            $table->string('ai_model')->nullable()->after('ai_draft');
            $table->string('reply_token', 32)->nullable()->after('ai_model');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['ai_draft', 'ai_model', 'reply_token']);
        });
    }
};
