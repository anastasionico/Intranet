<nav class="navbar navbar-inverse"> {{--navbar-fixed-top--}}
    
  <div class="container-fluid">
    <div id="navbar" class="navbar-collapse collapse">
      <span class="nav-brand">
        <a class="" href="/home">
          <img class="" src="/img/logo.png">
          Holiday Planner
          <sup>
            <small class="danger">BETA</small>
          </sup> 
          &nbsp;
          <small style="font-size: 0.6em">
            Imperial Commercials 
          </small>
        </a>
      </span>
      <ul class="nav navbar-nav navbar-right">
        <li>
          {{-- <form class="navbar-form navbar-right">
            <input type="text" class="form-control empty" placeholder="&#xF002; Search...">
          </form> --}}
        </li>
        @if(count($countPendingHolidayRequest) > 0)
          <li style="position: relative;">
            <a href="#">
              <i class="fa fa-spinner fa-pulse fa-fw"></i>
                <span class="sr-only"></span>
                <span class="notification-circle">
                    {{ count($countPendingHolidayRequest) }}
                </span>
            </a>
            <div style="position: absolute;top:50;left:-100%;width: 400px;z-index: 50; ">
              <ul>
                @foreach($countPendingHolidayRequest as $link)
                  <li style="list-style-type:none;">
                    <a href="/holiday/{{$link->id}}">
                      {{ $link->start->toFormattedDateString() }}
                    </a>
                  </li>
                @endforeach
              </ul>  
            </div>
          </li>
        @endif

        
        @if(count($countPendingHoliday) > 0)
          <li style="position: relative;">
            <a href="#">
              <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
              <span class="notification-circle">
                  {{ count($countPendingHoliday) }}
              </span>  
            </a>
            <div style="position: absolute;top:50;left:-100%;width: 400px;z-index: 50; ">
              <ul>
                @foreach($countPendingHoliday as $link)
                  <li style="list-style-type:none;">
                    <a href="/holiday/{{$link->id}}">
                      {{ $link->start->toFormattedDateString() }}
                    </a>
                  </li>
                @endforeach
              </ul>  
            </div>
            
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
        <li>
          <a href="#">{{ Auth::user()->name }}</a>
          
        </li>
        <li>
          <a href="/users/editpassword">
            <i class="fa fa-cog" aria-hidden="true"></i>
          </a>
        </li>
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
        </ul>
    </div>
  </div>
</nav>