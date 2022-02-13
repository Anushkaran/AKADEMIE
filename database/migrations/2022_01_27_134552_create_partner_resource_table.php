<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_resource', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('resource_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('partner_resource', function (Blueprint $table) {
            $table->dropForeign('partner_resource_partner_id_foreign');
            $table->dropForeign('partner_resource_resource_id_foreign');
        });
        Schema::dropIfExists('partner_resource');
    }
}
