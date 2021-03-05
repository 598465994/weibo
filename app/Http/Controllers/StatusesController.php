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

    /**
     * 删除微博
     * 这里我们使用的是『隐性路由模型绑定』功能，Laravel 会自动查找并注入对应 ID 的实例对象 $status，如果找不到就会抛出异常。
     */
    public function destroy(Status $status)
    {
        //授权策略自动注册，App\Policies\StatusPolicy.php里面的destroy方法。。。做删除授权的检测，不通过会抛出 403 异常
        $this->authorize('destroy', $status);
        //调用 Eloquent 模型的 delete 方法对该微博进行删除
        $status->delete();
        session()->flash('success', '微博已被删除成功！');
        //删除成功之后，将返回到执行删除微博操作的页面上。
        return redirect()->back();
    }
}
