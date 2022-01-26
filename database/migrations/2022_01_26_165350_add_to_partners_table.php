<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->integer('state')->default(1); // 1: active 2: unActive
            $table->string('legal_referent')->nullable();
            $table->string('legal_referent_phone')->nullable();
            $table->string('administrative_referent ')->nullable();
            $table->string('administrative_referent_phone ')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('state'); // 1: active 2: unActive
            $table->dropColumn('legal_referent');
            $table->dropColumn('legal_referent_phone');
            $table->dropColumn('administrative_referent ');
            $table->dropColumn('administrative_referent_phone ');
        });
    }
}
