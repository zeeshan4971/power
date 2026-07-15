<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username', 100)->nullable()->after('email');
            });

            DB::table('users')
                ->where('role', 'student')
                ->whereNull('username')
                ->orderBy('id')
                ->get(['id', 'email'])
                ->each(function ($user) {
                    $base = str_contains($user->email, '@')
                        ? strstr($user->email, '@', true)
                        : 'student'.$user->id;

                    $candidate = strtolower(preg_replace('/[^a-z0-9._-]+/i', '', $base));
                    $candidate = $candidate !== '' ? $candidate : 'student'.$user->id;
                    $original = $candidate;
                    $counter = 1;

                    while (DB::table('users')->where('username', $candidate)->exists()) {
                        $candidate = $original.$counter++;
                    }

                    DB::table('users')->where('id', $user->id)->update(['username' => $candidate]);
                });

            Schema::table('users', function (Blueprint $table) {
                $table->unique('username');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            });
        }
    }
};
