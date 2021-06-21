<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
        // هر سطری که اضافه شد، یک آیدی را ثبت کند
        $table->bigIncrements('id');

        // اعداد منفی را شامل نمی شود
        // ('user_id') = ('namemodel_id فیلدی که می خواهیم رابطه را برقرار بکنیم یا')
        $table->unsignedBigInteger('user_id');

        // $table->unsignedBigInteger('u_i');


        // با حذف کاربر، اطلاعات مربوط به آن مثل کامنت ها و آرتیکل ها و  غیره اش هم پاک شود
        // foreign('user_id') = کلید خارجی
        // references('id') -> ریفرنس به آیدی توی کلاس یوزر ها یا به نوعی به فیلد آیدی توی جدول یوزر ها
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->string('title',50);
        $table->string('slug',100);
        $table->text('body');
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
        Schema::dropIfExists('articles');
    }
}
