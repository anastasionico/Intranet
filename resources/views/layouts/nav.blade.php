<nav class="navbar navbar-inverse"> {{--navbar-fixed-top--}}
      
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="nav-brand">
        <a class="" href="/home">
          <img class="" src="/img/logo.png">
          Intranet Imperial Commercials
        </a>
      </span>
      <span class="date navbar-right">
        {{ date('d M Y') }}
        {{ date('   D H:m') }}
      </span>
      <form class="navbar-form navbar-right">
        <i class="fa fa-search" aria-hidden="true"></i>
        <input type="text" class="form-control" placeholder="Search...">
      </form>
      
    </div>
  </div>

  <div class="container-fluid">
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">{{ Auth::user()->name }}</a></li>
        <li>
          @if ( Auth::check())
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>  
          @endif
        </li>
      </ul>
      
    </div>
  </div>
</nav>