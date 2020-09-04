@extends('user.template')
@section('title', 'ユーザー管理 - 詳細')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
    <h4 class="mb-5">ユーザー詳細</h4>

    <div class="offset-9 col-2">
      <a href="{{ route('index') }}">一覧に戻る</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
    @endif

    <div class="inner-container"> 
      <div class="m-2 p-3 bg-white">

      <div class="user-group row">
        <label class="offset-1 col-2">名前</label>
        <div class="col-6">
          {{ $user->name }}
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">ログインID</label>
        <div class="col-6">
          {{ $user->login_id }}
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">メールアドレス</label>
        <div class="col-6">
          {{ $user->email }}
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">登録日</label>
        <div class="col-6">
          {{ $user->created_at->format('Y年n月j日') }}
        </div>
      </div>

    </div>
  </div>
  
  </div>
</div>
@endsection
