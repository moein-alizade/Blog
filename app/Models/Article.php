<?php

namespace App\Models;

//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // use Sluggable;
    use HasFactory;

    // فیلد های مجاز پر شدن توسط کاربر
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
        // را روی آن تعریف کنیم belongsTo هر آرتیکلی متعلق به یک کاربر هست. که می توانیم رابطه
        return $this->belongsTo(User::class);
    }


    public function categories(){

        // استفاده بکنیم belongsToMany() استفاده کرد و باید از hasMany() یک آرتیکل تعداد زیادی دسته بندی دارد ولی اینجا چون رابطه ی چند به چند هست نباید از
        //  Category::class => model Category
        return $this->belongsToMany(\App\Models\Category::class);
    }

    public function comments()
    {
        // است، می نویسیم. اینکار به دلیل است که ما می خواهیم نظرات سطح والد را نمایش دهیم و نیز این نظرات را ذخیره کنیم null شان برابر با  parent_id دراینجا ما همه نظراتی که که مقدار
        // تفاوت قائل شویم (reply) بدین ترتیب پس ما باید بین نظرات و پاسخ ها
        // morphMany() => ایجاد جدول مرکزی و ارتباطاتش را مشخص می کند مثل جدول نظرات برای جدول فیلم و خبر و مقاله و غیره و معنی اش چند وجه ای
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

}


