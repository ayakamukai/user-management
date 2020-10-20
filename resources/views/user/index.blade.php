@extends('user.template')
@section('content')
@include('user.header')
<div class="container">
  <div class="m-2 p-3">
    <h4 class="mb-5">ユーザー一覧</h4>

    <div class="offset-9 col-3">
      <a href="{{ route('create') }}">新規登録</a>
    </div>
    <div class="inner-container">
      <div class="m-2 p-3">

      <!-- 検索 -->
        <div class="border mb-5">
          <h6 class="m-3">検索</h6>
            <form method="get" action="{{ route('index') }}">

              <div class="row mb-3">
                <div class="offset-1 col-1">
                  <label class="control-label">名前</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" name="name_key" value="{{ isset($name_key) ? $name_key : ''}}"/>
                </div>
                <div class="col-2">
                  <label class="control-label">ログインID</label>
                </div>
                <div class="col-3">
                  <input type="text" class="form-control" name="id_key" value="{{ isset($id_key) ? $id_key : ''}}"/>
                </div>
                <div class="offset-2">
                </div>
              </div>

              <div class="row mb-3">
                <div class="offset-1 col-1">
                  <label class="control-label">性別</label>
                </div>
                <div class="col-3">
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sex_key" value="男" @if (isset($sex_key) && $sex_key == '男') checked @endif>
                    <label class="form-check-label">男</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sex_key" value="女" @if (isset($sex_key) && $sex_key == '女') checked @endif>
                    <label class="form-check-label">女</label>
                  </div>
                </diV>
            
                <div class="col-2">
                  <label class="control-label">都道府県</label>
                </div>
                <div class="col-3">
                  <select class="form-control" name="pref_key" id="pref_key">
                    <option value="" id="null">選択して下さい</option>
                     @foreach(config('pref') as $key => $name)
                    <option value="{{ $name }}" @if (isset($pref_key) && $pref_key == $name) selected @endif>{{ $name }}</option>
                     @endforeach
                  </select>
                </div>
                <div class="offset-2">
                </div>
              </div>

              <div class="row mb-3">
                <div class="offset-1 col-1">
                  <label class="control-label">登録日</label>
                </div>
                <div class="col-6 form-inline">
                  <input type="date" class="form-control" name="from_key" id="from_key" value="{{ isset($from_key) ? $from_key : '' }}"> ～ 
                  <input type="date" class="form-control" name="until_key" id="until_key" value="{{ isset($until_key) ? $until_key : '' }}">
                </div>
                <div class="offset-4">
                </div>
              </div>

                <div class="form-group text-center m-4">
                  <button type="submit" class="btn btn-info col-2 mr-2" id="search_btn">検索</button>
              </form>
                <a href="{{ route('index') }}" class="btn btn-light col-2">クリア</a>
              </div>
        </div>

      <!-- アラート -->
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        @if ($errors->has('ID'))
        <div class="alert alert-danger">
          {{ $errors->first('ID') }}
        </div>
        @endif

        <!-- 一覧 -->
        @if(count($users) > 0)
        <div class="row">
          <div class="col-2 mb-3">
            <h5>{{ $results }}件</h5>
          </div>
          <div class="col-10">
            <form action="{{ route('export') }}" method="post">
            {{ csrf_field() }}
              <input type="hidden" name="name_key" value="{{ isset($name_key) ? $name_key : ''}}"/>
              <input type="hidden" name="id_key" value="{{ isset($id_key) ? $id_key : ''}}"/>
              <input type="hidden" name="sex_key" value="{{ isset($sex_key) ? $sex_key : ''}}">
              <input type="hidden" name="pref_key" value="{{ isset($pref_key) ? $pref_key : ''}}">
              <input type="hidden" name="from_key" value="{{ isset($from_key) ? $from_key : ''}}">
              <input type="hidden" name="until_key" value="{{ isset($until_key) ? $suntilkey : ''}}">
              <button class="btn btn-success float-right">CSVダウンロード</button>
            </form>
          </div>
        </div>

        <table class="table table-bordered">
          <thead class="table-warning">
            <tr>
              <th scope="col-1">ID</th>
              <th scope="col">ログインID</th>
              <th scope="col">名前</th>
              <th scope="col-2"></th>
              <th scope="col-2"></th>
              <th scope="col-2"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->login_id }}</td>
              <td>{{ $user->name }}</td>
              <td><a href="{{ route('show', ['id' => $user->id]) }}">詳細</a></td>
              <td><a href="{{ route('edit', ['id' => $user->id]) }}">編集</a></td>
              <td>
                <form action="{{ route('delete', ['id' => $user->id]) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                  <input type="submit" value="削除" class="delete">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="row">
          <div class="col-2 mb-3">
            <h5>{{ $results }}件</h5>
          </div>
        </div>
        <h5>該当のユーザー登録がありません</h5>
      　@endif
      </div>
    </div>
    <div class="pagination justify-content-center">{{ $users->appends(request()->all())->links() }}</div>
  </div>
</div>

<script>
//削除
$('.delete').click(function(){
    if(!confirm('本当に削除しますか？')){
        return false;
    }
});

</script>
@endsection
