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
        Schema::table('liked_movies', function (Blueprint $table) {
            $table->renameColumn('Title', 'title');
            $table->year('year')->after('Title');
        });
        Schema::table('disliked_movies', function (Blueprint $table) {
            $table->renameColumn('Title', 'title');
            $table->year('year')->after('Title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liked_movies', function (Blueprint $table) {
            $table->renameColumn('title', 'Title');
            $table->dropColumn('year');
        });
        Schema::table('disliked_movies', function (Blueprint $table) {
            $table->renameColumn('title', 'Title');
            $table->dropColumn('year');
        });
    }
};
