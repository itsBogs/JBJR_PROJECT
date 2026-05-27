<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::table('user_accounts')->update(['must_change_password' => true]);
    }

    public function down(): void
    {
        \DB::table('user_accounts')->update(['must_change_password' => false]);
    }
};
