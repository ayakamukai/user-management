@extends('user.template')
@section('title', 'ユーザー管理 - 登録')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
    <h4 class="mb-5">ユーザー登録</h4>

    <div class="offset-9 col-2">
      <a href="{{ route('index') }}">一覧に戻る</a>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">エラーがありました！</div>
    @endif

    <div class="inner-container"> 
      <div class="m-2 p-3 bg-white">
      <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="offset-1 col-2">名前</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') }}">
          @if ($errors->has('name'))
          <div class="invalid-feedback">
            {{ $errors->first('name') }}
          </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">ログインID</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('login_id')) is-invalid @endif" name="login_id" value="{{ old('login_id') }}">
          @if ($errors->has('login_id'))
          <div class="invalid-feedback">
            {{ $errors->first('login_id') }}
          </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">メールアドレス</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}">
          @if ($errors->has('email'))
          <div class="invalid-feedback">
            {{ $errors->first('email') }}
          </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">パスワード</label>
        <div class="col-6">
          <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" name="password" value="{{ old('password') }}">
          @if ($errors->has('password'))
          <div class="invalid-feedback">
            {{ $errors->first('password') }}
          </div>
          @endif
        </div>
      </div>

      <div class="form-group row m-5">
       <button class="btn btn-primary offset-4 col-2" type="submit">登録する</button>
      </div>
    </form>

    </div>
  </div>
  
  </div>
</div>
@endsection
