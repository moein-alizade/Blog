<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'password_confirmed',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password_confirmed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // دیتا های آرتیکل های فلان یوزر را بازگردان (رابطه یک به چند)
    public function articles()
    {
        // hasMany(namemodel::class,'create_articles_table دقیقا کلید خارجی توی آرتیکل ') => یعنی تعداد زیادی آرتیکل وجود دارد
        // Article::class => خودمان ازش شی نمی سازیم و اجازه ایجاد کردن یک شی یا کلاس را به هسته لاراول می دهیم
        return $this->hasMany(\App\Models\Article::class);


        // return $this->hasMany(Article::class,'u_i','email');
        // متصل کن 'email' را به  'u_i' این فیلد
    }
}
