<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Options  $options
     * @return \Illuminate\Http\Response
     */

    // مشخص کردن تم فعال ما
    public function show()
    {

        // toArray() => تبدیل آلجکت به آرایه

        // object theme
        //  فعال ما را مشخض می کند، را باز می گرداند theme که توی دیتابیس هست که نهایتا یک ستون که  option هر چه در جدول
        $options = \App\Models\Options::first();


        // تغییر تم فعالمان توی دیتابیس
        // تغییر دهد و دوباره برگردد به صفحه اصلی theme1 بود آن را به  theme2 تغییر دهد و اگه  theme2 برود و مقدارش را به  option بود آنگاه توی همین دیتابیس  theme1 برابر با  $activeTheme اگه مقدار
        if ($options->theme == 'theme1')
        {
            $options->update(['theme' => 'theme2']);
        }
        else
        {
            $options->update(['theme' => 'theme1']);
        }

        return redirect('/');

    }

}
