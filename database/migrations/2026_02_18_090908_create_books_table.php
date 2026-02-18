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
            $table->string('isbn',13)->required();
            $table->text(column: 'description')->nullable();
            $table->date('publisher_date')->nullable();
            $table->unsignedInteger('page_count')->nullable();
            $table->string('language' ,2)->default('en');
            $table->unsignedSmallInt('edition')->default(1);
            $table->string('category_id')->nullable();
            $table->string('price')->nullable();
            $table->unsignedInteger('total_copies')->default(1);
            $table->string('author_id')->nullable();
            $table->string('publisher_id')->nullable();
            $table->enum('status',['available','borrowed', 'reserved','archived'])->default('available');
            $table->string('quantity')->nullable();
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
