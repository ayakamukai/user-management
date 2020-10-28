<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookmarkRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Bookmark;
use App\Models\User;
use Auth;

class BookmarkController extends Controller
{
  
    public function index($userId)
    {
        try {
            $bookmarks = User::findOrFail($userId)->bookmark()->get();
            $results = $bookmarks->count();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }
        return view('bookmark/index',['bookmarks' => $bookmarks, 'results' => $results, 'userId' => $userId]);
    }

    public function create($userId)
    {
        //ログインユーザー以外のブックマークを登録しようとしたらリダイレクト
        $loginUserId = Auth::id();
        if($loginUserId !== (int) $userId){
            return redirect()->route('bookmark.index',['loginUserId' => $loginUserId])->withErrors(['ID' => '自分のブックマークしか登録できません']);
        }

        $user = User::findOrFail($userId)->get();
        return view('bookmark.create',['user' => $user, 'userId' => $userId]);
    }

    //登録処理
    public function store(BookmarkRequest $request, $userId)
    {
        $bookmark = new Bookmark;
        $bookmark->user_id = $request->user_id;
        $bookmark->site_name = $request->site_name;
        $bookmark->url = $request->url;
        $bookmark->save();

        return redirect()->route('bookmark.index', ['userId' => $userId])->with('success', '正常に登録されました！');
    }
   
    //詳細
    public function show($id)
    {
        $loginUserId = Auth::id();
        try {
            $bookmark = Bookmark::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index', ['loginUserId' => $loginUserId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }

        //ログインユーザー以外のブックマークにアクセスしようとしたらリダイレクト
        $bookmarkUser = Bookmark::findOrFail($id)->user_id;
        if($loginUserId !== $bookmarkUser){
            return redirect()->route('bookmark.index', ['loginUserId' => $loginUserId])->withErrors(['ID' => '自分のブックマークしか閲覧できません']);
        }

        $user = $bookmark->user;
        return view('bookmark/show', ['bookmark' => $bookmark, 'user' => $user]);
    }

    //編集
    public function edit($id)
    {
        $loginUserId = Auth::id();
        try {
            $bookmark = Bookmark::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index', ['loginUserId' => $loginUserId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }

        //ログインユーザー以外のブックマークにアクセスしようとしたらリダイレクト
        $bookmarkUser = Bookmark::findOrFail($id)->user_id;
        if($loginUserId !== $bookmarkUser){
            return redirect()->route('bookmark.index', ['loginUserId' => $loginUserId])->withErrors(['ID' => '自分のブックマークしか編集できません']);
        }

        $user = $bookmark->user;
        return view('bookmark/edit', ['bookmark' => $bookmark, 'user' => $user]);
    }

    //更新
    public function update(BookmarkRequest $request, $id)
    {
        $loginUserId = Auth::id();
        try {
            $bookmark = Bookmark::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index', ['loginUserId' => $loginUserId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
            $bookmark->user_id = $request->user_id;
            $bookmark->site_name = $request->site_name;
            $bookmark->url = $request->url;
            $bookmark->save();
            $user = $bookmark->user;
        return redirect()->route('bookmark.index', ['user' => $user])->with('success', '正常に更新されました！');
    }
   
    //削除
    public function delete($id)
    {
        //ログインユーザー以外のブックマークを削除しようとしたらリダイレクト
        $bookmarkUser = Bookmark::findOrFail($id)->user_id;
        $loginUserId = Auth::id();
        if($loginUserId !== $bookmarkUser){
            return redirect()->route('bookmark.index',['loginUserId' => $loginUserId])->withErrors(['ID' => '自分のブックマークしか削除できません']);
        }

        try {
            $bookmark = Bookmark::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index', ['loginUserId' => $loginUserId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
        $user = $bookmark->user;
        $bookmark->delete();

        return redirect()->route('bookmark.index', ['user' => $user])->with('success', '正常に削除されました！');
    }
}