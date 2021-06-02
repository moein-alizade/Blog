<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldToArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // برای تغییر نوع و طول
            // $table->string('title',150)->change();
            // برای تغییر نام
            // $table->renameColumn('slug','slug_fa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            // $table->string('title',50)->change();
            // $table->renameColumn('slug_fa','slug');
        });
    }
}
