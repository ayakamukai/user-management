@extends('user.template')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
  <h4 class="mb-5">ユーザー詳細</h4>

    <div class="offset-9 col-3">
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
        <label class="offset-1 col-2">性別</label>
        <div class="col-6">
          @if(!empty($user->sex)) 
            @if($user->sex == 'male') <h5>男</h5>
            @elseif($user->sex == 'female') <h5>女</h5>
            @endif
          @else<h6>未登録</h6>
          @endif
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">都道府県</label>
        <div class="col-6">
          @if(!empty($user->prefecture)) {{ $user->prefecture }}
          @else<h6>未登録</h6>
          @endif
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">住所</label>
        <div class="col-6">
          @if(!empty($user->address)) {{ $user->address }}
          @else<h6>未登録</h6>
          @endif
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">備考</label>
        <div class="col-6">
          @if(!empty($user->note)) {{ $user->note }}
          @else<h6>未登録</h6>
          @endif
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
