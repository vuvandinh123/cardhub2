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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('horsepower')->nullable()->after('engine')->comment('Mã lực, ví dụ: 150 HP');
            $table->string('torque')->nullable()->after('horsepower')->comment('Mô men xoắn, ví dụ: 300 Nm');
            $table->string('fuel_consumption')->nullable()->after('torque')->comment('Tiêu hao nhiên liệu, ví dụ: 6.5L/100km');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['horsepower', 'torque', 'fuel_consumption']);
        });
    }
};
