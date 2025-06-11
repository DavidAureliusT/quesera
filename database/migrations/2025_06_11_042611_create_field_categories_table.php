<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('field_categories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        DB::table('field_categories')->insert(
            ['type' => 'Advanced'],
            ['type' => 'Date'],
            ['type' => 'Label'],
            ['type' => 'Number'],
            ['type' => 'Other'],
            ['type' => 'People'],
            ['type' => 'Select'],
            ['type' => 'System'],
            ['type' => 'Text'],
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_categories');
    }
};
