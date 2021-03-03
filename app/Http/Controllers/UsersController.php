<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        //Laravel 提供身份验证（Auth）中间件来过滤未登录用户的
        $this->middleware('auth', [
            //except 方法来设定 指定动作 不使用 Auth 中间件进行过滤。相反的还有 only 白名单方法，将只过滤指定动作
            'except' => ['create', 'store', 'index']
        ]);

        //只让未登录的用户访问create注册用户
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(6);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        $this->authorize('update', $user);
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //User::create()创建成功后返回一个用户对象
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //自动登录
        Auth::login($user);

        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $date = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }
}
