<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceResourceCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_resource_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('resource_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::table('resource_resource_category', function (Blueprint $table) {
            $table->dropForeign('resource_resource_category_resource_category_id_foreign');
            $table->dropForeign('resource_resource_category_resource_id_foreign');
        });
        Schema::dropIfExists('resource_resource_category');
    }
}
