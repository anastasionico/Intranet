<!DOCTYPE html>
<html lang="en">
  @include('layouts/head')
  <body onload="startTime()">
    <?php
      date_default_timezone_set("Europe/London");
    ?>
    <div class="container-full">
      <div class="row">
        <button class="btn btn-primary menuBar" type="button" data-toggle="collapse" data-target="#aside" aria-expanded="false" aria-controls="collapseExample">
          <i class="fa fa-2x fa-bars"></i>
        </button>
        <aside id="aside" class="col-sm-3 col-md-1 sidebar p-1 pt-0 collapse" style="background:linear-gradient(#004B80 90%, #eee);">
          @include('layouts/sidebar')
        </aside>  
        <div class="col-sm-9 col-md-11 p-0">
          @include('layouts/nav')
          @yield('heroDiv')
          @yield('sectionTable')
          @yield('aside')
        </div>

      </div><!-- end row-->
      
      @include('layouts/footer')
    </div>
  </body>
</html>
