<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('id_card_number', 255)->unique();
            $table->string('employee_name', 255);
            $table->string('designation', 255);

            // FK => departments.id (BIGINT UNSIGNED)
            $table->foreignId('department_id');

            $table->string('email', 255)->unique();
            $table->string('phone_number', 14)->unique();
            $table->string('nid_number', 20)->unique();
            $table->string('profile_photo')->nullable();
            $table->date('joining_date');
            $table->string('present_address', 255);
            $table->string('permanent_address', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

