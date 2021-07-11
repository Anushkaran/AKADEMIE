<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('evaluation_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('is_canceled')->default(false)->nullable();
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
        Schema::table('evaluation_student', function (Blueprint $table) {
            $table->dropForeign('evaluation_student_student_id_foreign');
            $table->dropForeign('evaluation_student_evaluation_id_foreign');
        });
        Schema::dropIfExists('evaluation_student');
    }
}
