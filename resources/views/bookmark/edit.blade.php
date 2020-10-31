@extends('user.template')
@include('user.header')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
    <h4 class="mb-5">ブックマーク編集</h4>

    <div class="offset-9 col-3">
      <a href="{{ route('bookmark.index', ['id' => Auth::id() ]) }}">一覧に戻る</a>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">エラーがありました！</div>
      {{ var_dump($errors) }}
    @endif

    <div class="inner-container"> 
      <div class="m-2 p-3 bg-white">
        <form action="{{ route('bookmark.update', $bookmark->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="form-group row">
          <label class="offset-1 col-2">サイト名</label>
          <div class="col-6">
            <input type="text" class="form-control @if ($errors->has('site_name')) is-invalid @endif" name="site_name" value="{{ old('site_name', $bookmark->site_name) }}">
            @if ($errors->has('site_name'))
              @foreach($errors->get('site_name') as $message)
                <div class="invalid-feedback">
                {{ $message }}
                </div>
              @endforeach
            @endif
          </div>
        </div>

        <div class="form-group row">
          <label class="offset-1 col-2">サイトURL</label>
          <div class="col-6">
            <textarea class="form-control @if($errors->has('note')) is-invalid @endif" name="note" rows="5">{{ old('url', $bookmark->url) }}</textarea>
            @if ($errors->has('url'))
              @foreach($errors->get('url') as $message)
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
