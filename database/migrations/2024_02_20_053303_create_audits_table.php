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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable(false);
            $table->text('link')->unique();
            $table->string('type')->nullable(false);
            $table->string('status')->nullable(false);
            $table->string('resolution')->nullable(false);
            $table->string('ninja')->nullable(false);
            $table->dateTime('start')->nullable(false);
            $table->dateTime('end')->nullable();
            $table->string('tat')->nullable();
            $table->date('shiftdate')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
