<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
        //auth中间键来过略用户
        $this->middleware('auth', [
            //except下的是不过略动作，only是需要过略的动作
            //'except' => ['store', 'destory(⊙o⊙)…'],
            //'only' => []
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        //$user->statuses()->create(); 微博自动与用户进行关联。。Auth::user();可以获取当前用户数据
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    public function destory()
    {

    }
}
