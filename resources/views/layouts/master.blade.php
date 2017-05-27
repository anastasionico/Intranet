<!DOCTYPE html>
<html lang="en">
  @include('layouts/head')
  <body>
    <div class="container-full">
      <div class="row">
        @include('layouts/sidebar')
        <div class="col-sm-8 col-md-10 p-0">
          @include('layouts/nav')
          @yield('heroDiv')
          @yield('sectionTable')
        </div>
      </div><!-- end row-->
      
      @include('layouts/footer')
    </div>
  </body>
</html>
