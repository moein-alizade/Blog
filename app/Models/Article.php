<?php

namespace App\Models;

//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // use Sluggable;
    use HasFactory;

    protected  $fillable = ['user_id','title','slug','body','image'];

    //    public function getRouteKeyName(){
    //        //کار کند route-model-binding به هر فیلدی که ما می خواهیم تا  id تغییر از
    //        return 'slug';
    //    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    //    بر اساس آرتیکل، دیتا های یوزرش را هم برگرداند
    public function user(){

        //  پیدا کند آرتیکلی که این کاربر ایجاد کرده است
        return $this->belongsTo(\App\Models\User::class);
    }


    public function categories(){

        // استفاده بکنیم belongsToMany() استفاده کرد و باید از hasMany() یک آرتیکل تعداد زیادی دسته بندی دارد ولی اینجا چون رابطه ی چند به چند هست نباید از
        //  Category::class = model Category
        return $this->belongsToMany(\App\Models\Category::class);
    }


}


