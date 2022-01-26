<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationPedagogicalReferentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_pedagogical_referent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pedagogical_referent_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('evaluation_pedagogical_referent', function (Blueprint $table) {
            $table->dropForeign('evaluation_pedagogical_referent_evaluation_id_foreign');
            $table->dropForeign('evaluation_pedagogical_referent_pedagogical_referent_id_foreign');
        });
        Schema::dropIfExists('evaluation_pedagogical_referent');
    }
}
