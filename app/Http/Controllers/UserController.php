<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
    
    //検索メソッド
    $users = User::search($request)->paginate(10);
    $results = User::search($request)->count();

    
    // $users = $query->paginate(10);

    // 条件キー
    $name_key = $request->query('name_key'); 
    $id_key = $request->query('id_key');
    $sex_key = $request->query('sex_key');
    $pref_key = $request->query('pref_key');
    $from_key = $request->query('from_key');
    $until_key = $request->query('until_key');

    //戻る用パラメータのセッション
    $back = http_build_query($request->query());
    session(['back' => $back]);
    $back_link = session('back');

        return view('user/index', ['users' => $users, 'name_key' => $name_key, 'id_key' => $id_key, 'sex_key' => $sex_key, 'pref_key' => $pref_key, 'from_key' => $from_key, 'until_key' => $until_key, 'results' => $results, 'back_link' => $back_link]);
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

    //CSVダウンロード
    public function export(Request $request)
    {
        //ユーザー情報(仮)
        $users = User::search($request)->get()->toArray();

        // ファイル名
        $filename = "users__".Carbon::now()->format('{YmdHis}').".csv";

        // カラムの作成
        $header = ['ID','名前','ログインID','メースアドレス','パスワード','作成日','更新日','性別','郵便番号','都道府県','住所','備考'];
        $lists = [];
        
        //ファイルopen
        $file = fopen('php://output', 'w');
        if ($file) {
            // カラムの書き込み
            mb_convert_variables('SJIS', 'UTF-8', $header);
            fputcsv($file, $header);
            
            // データの書き込み
            foreach ($users as $user) {
                    $row = '"';
                    $row.= implode('","', $user);
                    $row.= '"';
                    $row.= "\n";
                    $lists[] = $row;
            }
            foreach($lists as $list){
                mb_convert_variables('SJIS', 'UTF-8', $list);
                fwrite($file, $list);
            }
        }
        // ファイルclose
        fclose($file);

    // HTTPヘッダ
     header("Content-Type: application/octet-stream");
     header('Content-Disposition: attachment; filename='.$filename);
    }
}
