<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('evaluation_session_id')->constrained()->onDelete('cascade');
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
        Schema::table('session_students', function (Blueprint $table) {
            $table->dropForeign('session_students_student_id_foreign');
            $table->dropForeign('session_students_evaluation_session_id_foreign');
        });
        Schema::dropIfExists('session_students');
    }
}
