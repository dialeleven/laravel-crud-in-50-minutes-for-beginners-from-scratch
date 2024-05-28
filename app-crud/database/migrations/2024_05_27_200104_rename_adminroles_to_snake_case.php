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
        Schema::table('snake_case', function (Blueprint $table) {
            // rename 'adminroles' to 'admin_roles' to follow Laravel snake_case naming convention
            Schema::rename('adminroles', 'admin_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snake_case', function (Blueprint $table) {
            // undo the rename
            Schema::rename('admin_roles', 'adminroles');
        });
    }
};
