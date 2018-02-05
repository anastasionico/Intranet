  <ul class="nav nav-sidebar">
    <li class="text-center">
        {{ date('d m Y') }} 
    </li>
    <li class="text-center">
      <a href="#">
        <h3 id="realTime"></h3>
      </a>  
    </li>
    <li class="active">
      <a href="/admin">
        <i class="fa fa-dashboard" aria-hidden="true"></i> 
        Dashboard
        <span class="sr-only">(current)</span>
      </a>
    </li>
  </ul>  
  <ul class="nav nav-sidebar">
    <li>
      <a href="/users">
        <i class="fa fa-users" aria-hidden="true"></i> 
        User list
        <span class="sr-only">(current)</span>
      </a>
    </li>
    @permission(('user create'))
      <li>
      <a href="/users/create">
        <i class="fa fa-user-plus" aria-hidden="true"></i> 
        Add
      </a>
    </li>
    @endpermission
  </ul>
  <ul class="nav nav-sidebar">  
    <li>
      <a href="/permissions">
        <i class="fa fa-credit-card" aria-hidden="true"></i>
        Perms
      </a>
    </li>
    <li>
      <a href="/roles">
        <i class="fa fa-id-card-o" aria-hidden="true"></i>
        Roles
      </a>
    </li>
  </ul>
  <ul class="nav nav-sidebar">  
    <li>
      <a href="/tasks">
        <i class="fa fa-tasks" aria-hidden="true"></i>
        Task List
      </a>
    </li>
  </ul>
  <ul class="nav nav-sidebar">  
    <li>
      <a href="/company">
        <i class="fa fa-university" aria-hidden="true"></i>
        Co.
      </a>
    </li>
    <li>
      <a href="/sites">
        <i class="fa fa-home" aria-hidden="true"></i>
        Sites
      </a>
    </li>
    <li>
      <a href="/departments">
        <i class="fa fa-street-view" aria-hidden="true"></i>
        Depts
      </a>
    </li>
  </ul>
  <ul class="nav nav-sidebar">  
    <li>
      <a href="/calendar">
        <i class="fa fa-calendar" aria-hidden="true"></i>
        My Agenda
      </a>
    </li>
    <li>
      <a href="/holiday">
        <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
        Holiday
      </a>
    </li>
    @permission(('holiday report read'))
    <li>
      <a href="/holiday/reports">
        <i class="fa fa-files-o" aria-hidden="true"></i>
        Reports
      </a>
    </li>
    @endpermission
  </ul>