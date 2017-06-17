<!DOCTYPE html>
<html lang="en">
  @include('layouts/head')
  <body>
    <div class="container-full">
      <div class="row">
        <div class="col-sm-3 col-md-1 sidebar p-1 pt-0">
          @include('layouts/sidebar')
        </div>  
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
