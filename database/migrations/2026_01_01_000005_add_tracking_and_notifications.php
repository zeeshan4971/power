<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('success_criteria');
            $table->timestamp('last_progress_at')->nullable()->after('progress');
        });

        Schema::table('teacher_requests', function (Blueprint $table) {
            $table->foreignId('teacher_link_id')->nullable()->after('student_id')->constrained('teacher_links')->nullOnDelete();
            $table->timestamp('viewed_at')->nullable()->after('status');
            $table->timestamp('completed_at')->nullable()->after('viewed_at');
        });

        Schema::create('goal_progress_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedTinyInteger('progress');
            $table->string('source')->default('app');
            $table->timestamps();
        });

        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type');
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('action_url')->nullable();
            $table->string('dedupe_key')->unique();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_notifications');
        Schema::dropIfExists('goal_progress_logs');

        Schema::table('teacher_requests', function (Blueprint $table) {
            $table->dropForeign(['teacher_link_id']);
            $table->dropColumn(['teacher_link_id', 'viewed_at', 'completed_at']);
        });

        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'last_progress_at']);
        });
    }
};
