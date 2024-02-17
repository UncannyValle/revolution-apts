<?php

use App\Models\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->unique();
        });

        UserRole::insert([
            ['role' => 'admin'],
            ['role' => 'renter']
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('user_role_id')->constrained('user_roles');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_role_id');
        });
    }
};
