<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('students', 'name')) {
                $columnsToDrop[] = 'name';
            }

            if (Schema::hasColumn('students', 'age')) {
                $columnsToDrop[] = 'age';
            }

            if (Schema::hasColumn('students', 'course_program')) {
                $columnsToDrop[] = 'course_program';
            }

            if ($columnsToDrop !== []) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Re-introduce legacy columns only if needed.
            if (!Schema::hasColumn('students', 'name')) {
                $table->string('name')->nullable();
            }

            if (!Schema::hasColumn('students', 'age')) {
                $table->unsignedTinyInteger('age')->nullable();
            }

            if (!Schema::hasColumn('students', 'course_program')) {
                $table->string('course_program')->nullable();
            }
        });
    }
};
