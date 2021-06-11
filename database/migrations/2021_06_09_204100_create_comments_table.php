<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            // آیدی نویسنده
            $table->unsignedBigInteger('user_id');
            // آیدی والد نظر
            $table->unsignedBigInteger('parent_id')->nullable();
            // متن نظر
            $table->text('body');
            // مربوط به کدام آیدی مثلا مدل آرتیکل هست
            $table->unsignedBigInteger('commentable_id');
            // مربوط به کدوم مدل هست
            $table->string('commentable_type');
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
        Schema::dropIfExists('comments');
    }
}
