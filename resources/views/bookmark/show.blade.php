@extends('user.template')
@include('user.header')
@section('content')

<div class="container">
  <div class="m-2 p-3 bg-white">
  <h4 class="mb-5">ブックマーク詳細</h4>

    <div class="offset-9 col-3">
      <a href="{{ route('bookmark.index', ['id' => Auth::id() ]) }}">一覧に戻る</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
    @endif

    <div class="inner-container"> 
      <div class="m-2 p-3 bg-white">

      <div class="user-group row">
        <label class="offset-1 col-2">サイト名</label>
        <div class="col-6">
          {{ $bookmark->site_name }}
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">サイトURL</label>
        <div class="col-6">
          <a href ="{!! $bookmark->url !!}">リンク先へ移動する</a>
        </div>
      </div>

      <div class="user-group row">
        <label class="offset-1 col-2">登録日</label>
        <div class="col-6">
          {{ $bookmark->created_at->format('Y年n月j日') }}
        </div>
      </div>
    </div>
  </div>

  </div>
</div>
@endsection
