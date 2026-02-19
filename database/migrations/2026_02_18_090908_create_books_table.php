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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->nullable();
            $table->string('isbn',  13)->required();
            $table->text('description')->nullable();
            $table->date('publisher_date')->nullable();
            $table->unsignedInteger('page_count')->nullable();
            $table->string('language', 2)->default('en');
            $table->unsignedSmallInteger('edition')->default(1);
            $table->unsignedInteger('total_copies')->default(1);
            $table->foreignId('author_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('publisher_id')
                ->nullable()
                ->constrained();
            $table->enum('status', ['available', 'borrowed', 'reserved', 'archived'])->default('available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
