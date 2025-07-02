<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('id_card_number')->unique();
            $table->string('employee_name');
            $table->string('designation');
            $table->foreignId('department_id');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->text('address');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
