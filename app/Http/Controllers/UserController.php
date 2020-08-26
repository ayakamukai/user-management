<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('user/index', ['users' => $users]);
    }

    //登録
    public function create()
    {
        return view('user/create');
    }

    //登録処理
    public function store(Request $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->login_id = $request->login_id;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('index');
    }

    //詳細
    public function show($id)
    {
        $user = User::find($id);
        return view('user/show', ['user' => $user]);
    }

    //編集
    public function edit($id)
    {
        $user = User::find($id);
        return view('user/edit', ['user' => $user]);
    }

    //更新
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->name;
        $user->login_id = $request->login_id;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('index');
    }

    //削除
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('index');
    }
}
