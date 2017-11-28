<!DOCTYPE html>
<html lang="en">
  @include('layouts/head')
  <body onload="startTime()">
    <?php
      date_default_timezone_set("Europe/London");
    ?>
    <div class="container-full">
      <div class="row">
        <aside class="col-sm-3 col-md-1 sidebar p-1 pt-0" style="background:linear-gradient(#292945, #292945 80%, #335);">
          @include('layouts/sidebar')
        </aside>  
        <div class="col-sm-8 col-md-11 p-0">
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
