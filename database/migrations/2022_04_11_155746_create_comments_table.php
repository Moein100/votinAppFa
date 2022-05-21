<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('idea_id')->constrained('ideas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('status_id')->constrained('statuses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('body');
            $table->integer('spam_reports')->default(0);
            $table->string('image')->nullable()->default(null);
            $table->boolean('is_status_update')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
