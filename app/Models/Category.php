<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    //    با گرفتن دسته بندی، آرتیکل های مرتبط با آن را بر می گرداند
    public function articles(){
        //        استفاده بکنیم belongsToMany() استفاده کرد و باید از  hasMany() یک دسته بندی تعداد زیادی آرتیکل دارد ولی اینجا چون رابطه ی چند به چند هست نباید از
        //        Article::class = model Category
        return $this->belongsToMany(\App\Models\Article::class);
    }
}
