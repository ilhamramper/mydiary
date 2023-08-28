<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->dropForeign(['reaction_id']);
            $table->dropColumn('reaction_id');
            $table->string('unicode_hex')->nullable()->after('content');
            $table->foreign('unicode_hex')->references('unicode_hex')->on('reactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
