<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('content_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_done')->default(false);
            $table->timestamp('done_at')->nullable();
            $table->unique(['content_id','user_id']);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('content_progress');
    }
};
