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
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したユーザーが存在しません']);
        }
        $bookmarks = $user->bookmark()->get();
        $results = $bookmarks->count();

        return view('bookmark/index', ['bookmarks' => $bookmarks, 'results' => $results, 'user' => $user]);
    }

    public function create()
    {
        return view('bookmark.create');
    }

    //登録処理
    public function store(BookmarkRequest $request)
    {
        $userId = Auth::id();

        $bookmark = new Bookmark;
        $bookmark->user_id = $userId;
        $bookmark->site_name = $request->site_name;
        $bookmark->url = $request->url;
        $bookmark->save();

        return redirect()->route('bookmark.index', ['userId' => $userId])->with('success', '正常に登録されました！');
    }
   
    //詳細
    public function show($bookmarkId)
    {
        $userId = Auth::id();

        $bookmark = Bookmark::where('user_id', $userId)->where('id', $bookmarkId)->first();

        if(!empty($bookmark)){
            return view('bookmark/show', ['bookmark' => $bookmark]);
        }else{
            return redirect()->route('bookmark.index', ['userId' => $userId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
    }

    //編集
    public function edit($bookmarkId)
    {
        $userId = Auth::id();

        $bookmark = Bookmark::where('user_id', $userId)->where('id', $bookmarkId)->first();

        if(!empty($bookmark)){
            return view('bookmark/edit', ['bookmark' => $bookmark]);
        }else{
            return redirect()->route('bookmark.index', ['userId' => $userId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }

    }

    //更新
    public function update(BookmarkRequest $request, $bookmarkId)
    {
        $userId = Auth::id();

        $bookmark = Bookmark::where('user_id', $userId)->where('id', $bookmarkId)->first();

        if(!empty($bookmark)){

            $bookmark->user_id = $userId;
            $bookmark->site_name = $request->site_name;
            $bookmark->url = $request->url;
            $bookmark->save();

            return redirect()->route('bookmark.index', ['userId' => $userId])->with('success', '正常に更新されました！');
        }else{
            return redirect()->route('bookmark.index', ['userId' => $userId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }
    }


    //削除
    public function delete($bookmarkId)
    {
        $userId = Auth::id();

        $bookmark = Bookmark::where('user_id', $userId)->where('id', $bookmarkId)->first();

        if(!empty($bookmark)){
            $bookmark->delete();
            return redirect()->route('bookmark.index', ['userId' => $userId])->with('success', '正常に削除されました！');
        }else{
            return redirect()->route('bookmark.index', ['userId' => $userId])->withErrors(['ID' => '指定したブックマークが存在しません']);
        }

    }
}