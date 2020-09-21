@extends('user.template')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
    <h4 class="mb-5">ユーザー編集</h4>

    <div class="offset-9 col-3">
      <a href="{{ route('index') }}">一覧に戻る</a>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">エラーがありました！</div>
    @endif

    <div class="inner-container"> 
      <div class="m-2 p-3 bg-white">
      <form action="{{ route('update', $user->id) }}" method="post">
      {{ csrf_field() }}
      {{ method_field('PUT') }}

      <div class="form-group row">
        <label class="offset-1 col-2">名前</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', $user->name) }}">
          @if ($errors->has('name'))
            @foreach($errors->get('name') as $message)
             <div class="invalid-feedback">
             {{ $message }}
             </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">ログインID</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('login_id')) is-invalid @endif" name="login_id" value="{{ old('login_id', $user->login_id) }}">
          @if ($errors->has('login_id'))
            @foreach($errors->get('login_id') as $message)
             <div class="invalid-feedback">
             {{ $message }}
             </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">メールアドレス</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', $user->email) }}">
          <small class="form-text text-muted">記入例：abc_123@email.com</small>
          @if ($errors->has('email'))
            @foreach($errors->get('email') as $message)
             <div class="invalid-feedback">
             {{ $message }}
             </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">パスワード</label>
        <div class="col-6">
          <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" name="password" value="{{ old('password') }}">
          <small class="form-text text-muted">パスワードは8～32文字の半角英字、半角ハイフンまたは半角アンダースコアのみ<br>使用可能です</small>
          @if ($errors->has('password'))
            @foreach($errors->get('password') as $message)
             <div class="invalid-feedback">
             {{ $message }}
             </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">性別</label>
        <div class="col-6">
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input @if ($errors->has('sex')) is-invalid @endif" name="sex" value="male"　@if(old('sex', $user->sex) == "male") checked @endif>
            <label class="form-check-label">男</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input @if ($errors->has('sex')) is-invalid @endif" name="sex" value="female"　@if(old('sex', $user->sex) == "female") checked @endif>
            <label class="form-check-label">女</label>
          </div>
          @if ($errors->has('sex'))
             <div class="invalid-feedback">
             {{ $errors->first('sex') }}
             </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">郵便番号</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('zip')) is-invalid @endif" name="zip" value="{{ old('zip', $user->zip) }}">
          <small class="form-text text-muted">記入例：12311111または123-1111</small>
          @if ($errors->has('zip'))
            @foreach($errors->get('zip') as $message)
             <div class="invalid-feedback">
             {{ $message }}
             </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">都道府県</label>
        <div class="col-6">
          <select class="form-control @if($errors->has('prefecture')) is-invalid @endif" name="prefecture">
            <option value="">選択して下さい</option>
            @foreach(config('pref') as $key => $name)
            <option value="{{ $name }}" @if(old('prefecture', $user->prefecture) == $name) selected @endif>{{ $name }}</option>
            @endforeach
          </select>
          @if ($errors->has('prefecture'))
          <div class="invalid-feedback">
           {{ $errors->first('prefecture') }}
          </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">住所</label>
        <div class="col-6">
          <input type="text" class="form-control @if ($errors->has('address')) is-invalid @endif" name="address" value="{{ old('address', $user->address) }}">
          <small class="form-text text-muted">市区町村以下を記入して下さい</small>
          @if ($errors->has('address'))
            @foreach($errors->get('address') as $message)
             <div class="invalid-feedback">
             {{ $message }}
             </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="offset-1 col-2">備考</label>
        <div class="col-6">
          <textarea class="form-control @if($errors->has('note')) is-invalid @endif" name="note" rows="5">{{ old('note', $user->note) }}</textarea>
            @if ($errors->has('note'))
              @foreach($errors->get('note') as $message)
                <div class="invalid-feedback">
                {{ $message }}
                </div>
              @endforeach
            @endif
        </div>
      </div>

      <div class="form-group row m-5">
       <button class="btn btn-primary offset-4 col-2" type="submit">更新する</button>
      </div>
    </form>

    </div>
  </div>
  </div>
</div>
@endsection
