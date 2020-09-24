<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
    //条件キー
    $name_key = $request->input('name_key'); 
    $id_key = $request->input('id_key');
    $sex_key = $request->input('sex_key');
    $pref_key = $request->input('pref_key');
    $from_key = $request->input('from_key');
    $until_key = $request->input('until_key');

    //検索
    $query = User::query();
    if(!empty($name_key)){
        $query->where('name', 'like', '%'.$name_key.'%');
    }
    if(!empty($id_key)){
        $query->where('login_id', $id_key);
    }
    if(!empty($sex_key)){
        $query->where('sex', $sex_key);
    }
    if(!empty($pref_key)){
        $query->where('prefecture', $pref_key);
    }
    if(!empty($from_key) && !empty($until_key)){
        $query->whereBetween('created_at', [$from_key, $until_key]);
    }elseif(!empty($from_key) && empty($until_key)){
        $query->where('created_at', '>', $from_key);
    }elseif(empty($from_key) && !empty($until_key)){
        $query->where('created_at', '<', $until_key);
    }
    $results = $query->count();
    $users = $query->paginate(5);

    //戻る用パラメータのセッション
    $back = http_build_query($request->input());
    session(['back' => $back]);

        return view('user/index', ['users' => $users, 'name_key' => $name_key, 'id_key' => $id_key, 'sex_key' => $sex_key, 'pref_key' => $pref_key, 'from_key' => $from_key, 'until_key' => $until_key, 'results' => $results ]);
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
         //戻るリンク用のパラメータ
        $back_link = session('back');       

        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }

        return view('user/show', ['user' => $user, 'back_link' => $back_link]);
    }

    //編集
    public function edit($id)
    {
        //戻るリンク用のパラメータ
        $back_link = session('back');  
        
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }

        return view('user/edit', ['user' => $user, 'back_link' => $back_link]);
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
        if(!empty($request->password)){
          $user->password =$request->password;
        }
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
