@extends('user.template')

@section('content')
<div class="container">
<div class="m-5 p-5">
  <div class="border mb-5">
    <h6 class="m-3">ログイン</h6>

    <!-- エラー -->
    @if(!empty($errors))
      <div class="alert alert-danger">
        {{ $errors }}
      </div>
    @endif

    <form action="{{ route('postLogin') }}" method="post">
    {{ csrf_field() }}
      <div class="row mb-3">
        <div class="offset-3 col-2">
          <label class="control-label">ログインID</label>
        </div>
        <div class="col-3">
          <input type="text" class="form-control" name="login_id" value="{{ isset($login_id) ? $login_id : ''}}"/>
        </div>
      </div>
      <div class="row mb-3">
        <div class="offset-3 col-2">
          <label class="control-label">パスワード</label>
        </div>
        <div class="col-3">
          <input type="password" class="form-control" name="password" value="{{ isset($password) ? $password : ''}}"/>
        </div>
      </div>
      <div class="form-group text-center m-4">
        <button type="submit" class="btn btn-primary col-3">ログインする</button>
      </div>
    </form>
  </div>
</div>
</div>

@endsection
