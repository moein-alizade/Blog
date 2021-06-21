<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['body','user_id','parent_id'];

    // ایجاد رابطه ای بین نظر و کاربر
    public function user()
    {
        // برای تعریف ارتباط بین نظرات با آرتیکل ها
        return $this->belongsTo(User::class);
    }

    // ایجاد رابطه ای بین نظر و پاسخ
    public function replies()
    {
        //  یا همان پاسخ مربوط به شناسه نظر والد آن برگردانیم reply ایجاد می کنیم. چون می خواهیم یک  parent_id یک کلید اصلی بنام  replies در متد
        return $this->hasMany(\App\Models\Comment::class, 'parent_id');
    }
}
