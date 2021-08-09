<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionStudentTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_student_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('session_student_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

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
        Schema::table('session_student_task', function (Blueprint $table) {
            $table->dropForeign('session_student_task_student_id_foreign');
            $table->dropForeign('session_student_task_session_student_id_foreign');
            $table->dropForeign('session_student_task_task_id_foreign');
            $table->dropForeign('session_student_task_user_id_foreign');
        });
        Schema::dropIfExists('session_student_task');
    }
}
