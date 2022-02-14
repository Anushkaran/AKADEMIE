<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerSheetSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_sheet_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('header_image',1000)->nullable();
            $table->string('footer_image',1000)->nullable();
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
        Schema::table('partner_sheet_settings', function (Blueprint $table) {
            $table->dropForeign('partner_sheet_settings_partner_id_foreign');
        });
        Schema::dropIfExists('partner_sheet_settings');
    }
}
