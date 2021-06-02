<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User1;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//گه کاربر قبلا لاگین کرده باشد آنگاه صفحه رجیستری را نباید نشان بدیم بلکه باید کاربر را به صفحه اصلی ریدایرکت کنیم
        if (auth()->check()){
            return redirect('/');
        }


        return view('auth.user-register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
//            نام کاربر باید حتما وارد بشود و فقط کاراکتر باشد
            'name' => 'required|alpha',
//            ایمیل کاربر باید حتما وارد بشود و ایمیل باشد و ایمیل کاربر یکتا یعنی تکرار نباشد
            'email' => 'required|email|unique:users,email',
//            پسورد کاربر باید حتما وارد بشود
            'password' => 'required',
//            تایید پسورد حتما باید وارد بشود
            'passwordconfirm' => 'required',

        ]);



// نیست و داخل دیتابیس بصورت نامفهوم و هش شده نشان می دهد password رمز کاربر برابر با همان رمزی که خودشان وارد می کنند هست  و  برابر با
        $data['password'] = bcrypt($data['password']);


//       می ریزد $user تمام اطلاعات کاربر ثبت نام شده را درون متغیر
        $user = \App\Models\User::create($data);

//توسط آیدی کاربر، آن را لاگین می کند
        auth()->loginUsingId($user->id);




// ریدایرکت به صفحه آرتیکل ها و به همراه آن یک اعلان با پیام موفقیت آمیز را نشان می دهد
        return redirect('/admin/articles')
            ->with('success', 'User created successfully');


    }


}
