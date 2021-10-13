<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('evaluation_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')
                ->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()
                ->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('name');
            $table->boolean('is_final')->default(false);
            $table->date('date');
            $table->string('note')->nullable();
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

        Schema::dropIfExists('evaluation_sessions');
    }
}
