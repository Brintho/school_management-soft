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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->unique();
            $table->string('slug')->unique();
            $table->string('code')->nullable()->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->unsignedBigInteger('institute_type_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();

            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->string('admin_email')->unique();
            $table->string('admin_password')->nullable();

            $table->boolean('is_admission_going')->default(false);
            $table->enum('status', ['pending', 'active', 'inactive'])->default('active');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
