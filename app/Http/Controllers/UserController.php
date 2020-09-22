<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;

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
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->login_id = $request->login_id;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->sex = $request->sex;
        $user->zip = $request->zip;
        $user->prefecture = $request->prefecture;
        $user->address = $request->address;
        $user->note = $request->note;
        $user->save();

        return redirect()->route('show', ['user' => $user])->with('success', '正常に登録されました！');
    }

    //詳細
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }

        return view('user/show', ['user' => $user]);
    }

    //編集
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }

        return view('user/edit', ['user' => $user]);
    }

    //更新
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }
        $user->name = $request->name;
        $user->login_id = $request->login_id;
        $user->email = $request->email;
        if(!empty($request->password)){ $user->password =$request->password; }
        $user->sex = $request->sex;
        $user->zip = $request->zip;
        $user->prefecture = $request->prefecture;
        $user->address = $request->address;
        $user->note = $request->note;
        $user->save();

        return redirect()->route('index')->with('success', '正常に更新されました！');
    }

    //削除
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }
        $user->delete();

        return redirect()->route('index')->with('success', '正常に削除されました！');;
    }
}
