<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('evaluation_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('skill_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('evaluation_skill', function (Blueprint $table) {
            $table->dropForeign('evaluation_skill_skill_id_foreign');
            $table->dropForeign('evaluation_skill_evaluation_id_foreign');
        });
        Schema::dropIfExists('evaluation_skill');
    }
}
