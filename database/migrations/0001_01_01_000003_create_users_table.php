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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('description')->nullable();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Proper foreign key constraint
            $table->string('profile_image')->nullable();
            $table->timestamp('email_verified_at')->nullable(); // Ensure this is nullable
            $table->string('password')->nullable();
            $table->rememberToken(); // Optional
            $table->timestamps();  // Adding timestamps
        });
    }

    // public function up(): void
    // {
    //     if (Schema::hasTable('roles')) {
    //         Schema::create('users', function (Blueprint $table) {
    //             $table->id();
    //             $table->string('name');
    //             $table->string('email')->unique();
    //             $table->string('phone');
    //             $table->text('description')->nullable();
    //             $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
    //             $table->string('profile_image')->nullable();
    //             $table->timestamps();
    //         });
    //     }
    // }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
