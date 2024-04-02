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
        Schema::create('event_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('member_id');
            $table->string('status');
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_member');
    }
};
