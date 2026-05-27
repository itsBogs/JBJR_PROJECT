<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'first_name')) {
                $table->string('first_name')->nullable()->after('id');
            }

            if (!Schema::hasColumn('students', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }

            if (!Schema::hasColumn('students', 'email_address')) {
                $table->string('email_address')->nullable()->after('contact_number');
            }

            if (!Schema::hasColumn('students', 'degree_id')) {
                $table->foreignId('degree_id')->nullable()->after('email_address')->constrained('degrees');
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'degree_id')) {
                $table->dropConstrainedForeignId('degree_id');
            }

            if (Schema::hasColumn('students', 'email_address')) {
                $table->dropColumn('email_address');
            }

            if (Schema::hasColumn('students', 'last_name')) {
                $table->dropColumn('last_name');
            }

            if (Schema::hasColumn('students', 'first_name')) {
                $table->dropColumn('first_name');
            }
        });
    }
};
