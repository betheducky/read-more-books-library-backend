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
        Schema::table('books', function (Blueprint $table) {
            $table->string('cover_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * Make sure no NULL values exist if rollback is ever necessary.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('cover_url')->nullable(false)->change();
        });
    }
};
