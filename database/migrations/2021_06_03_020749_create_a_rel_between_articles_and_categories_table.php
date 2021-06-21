<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateARelBetweenArticlesAndCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // a_rel_between_articles_and_categories => این سعی می کند یک جدول با عنوان درست بکند که ما بهش نیاز نداریم

    // 'article_category' => اسم جدول رابط باید ترکیبی از اسم دو تا مدل و بر اساس ترتیب حروف الفبا باشد
    Schema::create('article_category', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id');
            // اکه می خواهیم با حذف شدن یک آرتیکل، اون دسته بندی هاش هم حذف بشود
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            // unique(['article_id', 'category_id']) => باید یکتا باشد و توی یک سطر مقدار تکرای نداشته باشند  article_id & category_id برای اینکه نتوانیم هیچ دو سطری با هم برابر باشند یعنی
            $table->unique(['article_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    //یعنی هر وقت ما رولبک زدیم، این را برای ما حذف بکند
    public function down()
    {
        Schema::dropIfExists('article_category');
    }
}
