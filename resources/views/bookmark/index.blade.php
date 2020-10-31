@extends('user.template')
@include('user.header')
@section('content')

<div class="container">
  <div class="m-2 p-3">
    <h4 class="mb-5"><span>{{ $user->name }}</span>のブックマーク一覧</h4>

      <div class="offset-9 col">
        <a href="{{ route('index') }}">ユーザー一覧へ戻る</a>
      </div>
    
    <div class="inner-container">
      <div class="m-2 p-3">

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
        @if(count($bookmarks) > 0)
        <div class="row">
          <div class="col-2 mb-3">
            <h5>{{ $results }}件</h5>
          </div>
          @if(Auth::id() == $user->id)
            <div class="offset-8 col-2">
              <a href="{{ route('bookmark.create') }}">新規登録</a>
            </div>
          @endif
          
        </div>

        <table class="table table-bordered">
          <thead class="table-warning">
            <tr>
              <th scope="col-1">ID</th>
              <th scope="col">サイト名</th>
              <th scope="col-2"></th>
              <th scope="col-2"></th>
              <th scope="col-2"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bookmarks as $bookmark)
            <tr>
              <td>{{ $bookmark->id }}</td>
              <td>{{ $bookmark->site_name }}</td>
              <td>
                @if(Auth::id() == $bookmark->user_id)<a href="{{ route('bookmark.show', ['id' => $bookmark->id]) }}">詳細</a>
                @else<span>詳細</span>
                @endif
              </td>
              <td>
                @if(Auth::id() == $bookmark->user_id)<a href="{{ route('bookmark.edit', ['id' => $bookmark->id]) }}">編集</a>
                @else<span>編集</span>
                @endif
                </td>
              <td>
                @if(Auth::id() == $bookmark->user_id)
                <form action="{{ route('bookmark.delete', ['id' => $bookmark->id]) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                  <input type="submit" value="削除" class="delete">
                </form>
                @else<span>削除</span>
                @endif
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
        <h5>ブックマーク登録がありません</h5>
      　@endif
      </div>
    </div>
  
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
