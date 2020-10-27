<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookmarkRequest;
use App\Models\Bookmark;
use App\Models\User;

class BookmarkController extends Controller
{
  
    public function index($userId)
    {
        $bookmarks = User::findOrFail($userId)->bookmark()->get();
        $results = $bookmarks->count();

        return view('bookmark/index',['bookmarks' => $bookmarks, 'results' => $results, 'userId' => $userId]);
    }

    public function create($userId)
    {
        try {
            $user = User::findOrFail($userId)->get();;
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index')->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
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
        try {
            $bookmark = Bookmark::findOrFail($id);
            $user = $bookmark->user;
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index')->withErrors(['ID' => '指定したブックマークが存在しません']);
        }

        return view('bookmark/show', ['bookmark' => $bookmark, 'user' => $user]);
    }

    //編集
    public function edit($id)
    {
        try {
            $bookmark = Bookmark::findOrFail($id);
            $user = $bookmark->user;
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index')->withErrors(['ID' => '指定したブックマークが存在しません']);
        }

        return view('bookmark/edit', ['bookmark' => $bookmark, 'user' => $user]);
    }

    //更新
    public function update(BookmarkRequest $request, $id)
    {
        try {
            $bookmark = Bookmark::findOrFail($id);
            $user = $bookmark->user;
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index', ['user' => $user])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
            $bookmark->user_id = $request->user_id;
            $bookmark->site_name = $request->site_name;
            $bookmark->url = $request->url;
            $bookmark->save();
        return redirect()->route('bookmark.index', ['user' => $user])->with('success', '正常に更新されました！');
    }
   
    //削除
    public function delete($id)
    {
        try {
            $bookmark = Bookmark::findOrFail($id);
            $user = $bookmark->user;
        } catch (ModelNotFoundException $e) {
            return redirect()->route('bookmark.index', ['user' => $user])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
        $bookmark->delete();

        return redirect()->route('bookmark.index', ['user' => $user])->with('success', '正常に削除されました！');
    }
}