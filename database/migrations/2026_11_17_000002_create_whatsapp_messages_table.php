<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->id();
            $table->string('wa_message_id', 128)->nullable()->index();
            $table->string('chat_id', 64)->index();
            $table->string('phone', 32)->nullable()->index();
            $table->string('name', 128)->nullable();
            $table->string('type', 24)->default('text');
            $table->text('body')->nullable();
            $table->timestamp('received_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_messages');
    }
};
