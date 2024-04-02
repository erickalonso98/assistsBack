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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('municipalitie_id');
            $table->unsignedBigInteger('localitie_id');
            $table->timestamps();

            $table->foreign('state_id')
                  ->references('id')
                  ->on('states');

            $table->foreign('municipalitie_id')
                  ->references('id')
                  ->on('municipalities');

            $table->foreign('localitie_id')
                  ->references('id')
                  ->on('localities');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
