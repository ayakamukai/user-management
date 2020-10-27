<!-- Styles -->
<style>
  .logout:hover{
  color: #F00;
  text-decoration: underline;
}

</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <p class="navbar-brand">Laravel</p>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="Navber">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <span class="nav-link">ログイン者：{{ Auth::user()->name }}</span>
      </li>
      @if(Auth::check())
      <li class="nav-item active logout">
        <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
      </li>
      @endif
    </ul>

  </div><!-- /.navbar-collapse -->
</nav>