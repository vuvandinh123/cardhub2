<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('accessory_category_id')
                ->constrained('accessory_categories')
                ->cascadeOnDelete();
            $table->foreignId('car_id')
                ->nullable()
                ->constrained('cars')
                ->nullOnDelete();
            $table->string('sku')->nullable()->unique();
            $table->decimal('price', 15, 2)->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accessories');
    }
};

