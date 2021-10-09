<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationSessionTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_session_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_session_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('task_id')
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
    public function down()
    {
            Schema::table('evaluation_skill', function (Blueprint $table) {
                $table->dropForeign('evaluation_session_task_task_id_foreign');
                $table->dropForeign('evaluation_session_task_evaluation_session_id_foreign');
            });
        Schema::dropIfExists('evaluation_session_task');
    }
}
