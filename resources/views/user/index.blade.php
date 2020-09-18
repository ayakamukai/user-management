@extends('user.template')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
    <h4 class="mb-5">ユーザー一覧</h4>

    <div class="offset-9 col-3">
      <a href="{{ route('create') }}">新規登録</a>
    </div>

    <div class="inner-container">
      <div class="m-2 p-3 bg-white">
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
        <h5>ユーザー登録がありません</h5>
      　@endif
      </div>
    </div>
    <div class="pagination justify-content-center">{{ $users->links() }}</div>
  </div>
</div>

<script>
$('.delete').click(function(){
    if(!confirm('本当に削除しますか？')){
        return false;
    }
});
</script>
@endsection
