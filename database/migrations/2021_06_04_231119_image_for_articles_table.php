<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImageForArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // و می تواند مقدارش خالی باشد body اضافه کردن یک ستون جدید از نوع رشته و بعداز ستون
            // after() => یعنی بعد از چه ستونی این ستون جدید را ایجاد کن
            $table->string('image')->after('body')->nullable();
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
            // image حذف ستون
            $table->dropColumn('image');
        });
    }
}
