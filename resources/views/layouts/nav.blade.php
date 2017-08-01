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
          <sup>
            <small class="danger">BETA</small>
          </sup>
        </a>
      </span>
      <span class="date navbar-right">
        {{ date('d m Y') }} | {{ date('h:i a') }}
      </span>
      {{-- <form class="navbar-form navbar-right">
        <input type="text" class="form-control empty" placeholder="&#xF002; Search...">
      </form> --}}
      
    </div>
  </div>

  <div class="container-fluid">
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        @if($countPendingHolidayRequest > 0)
          <li style="position: relative;">
            <a href="/holiday">
              <i class="fa fa-spinner fa-pulse fa-fw"></i>
                <span class="sr-only"></span>
                <span class="notification-circle">
                    {{ $countPendingHolidayRequest }}
                </span>
            </a>
          </li>
        @endif
        @if($countPendingHoliday > 0)
          <li style="position: relative;">
            <a href="/holiday">
              <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                <span class="notification-circle">
                    {{ $countPendingHoliday }}
                </span>
            </a>
          </li>
        @endif
        @if($countTodayEvent > 0)
          <li style="position: relative;">
            <a href="/calendar">
              <i class="fa fa-calendar" aria-hidden="true"></i>
                <span class="notification-circle">
                    {{ $countTodayEvent }}
                </span>
            </a>
          </li>
        @endif
        @if($countTasks > 0)
          <li style="position: relative;">
            <a href="/tasks">
              <i class="fa fa-tasks" aria-hidden="true"></i>
                <span class="notification-circle">
                    {{ $countTasks }}
                </span>
            </a>
          </li>
        @endif
        <li><a href="/users/editpassword"><i class="fa fa-cog" aria-hidden="true"></i></a></li>
        <li>
          @if ( Auth::check())
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>  
          @endif
        </li>
        <li><a href="#">{{ Auth::user()->name }}</a></li>
      </ul>
      
    </div>
  </div>
</nav>