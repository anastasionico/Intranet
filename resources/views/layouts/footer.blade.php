<footer>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      {{-- <!-- google map api start -->
      <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1pBKIr5tob6VQIO8ZStb1XgDJ-XrljXE&callback=initMap">
      </script>     
      <!-- google map api stop --> --}}
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
      {{-- <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script> --}}
      {{-- <script src="../../dist/js/bootstrap.min.js"></script>   //doesn't work  --}}
      <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
      {{-- <script src="../../assets/js/vendor/holder.min.js"></script>   //doesn't work  --}}
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      {{-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>    //doesn't work  --}}
      {{-- tooltip bootstrap--}}
      {{-- <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
      </script> --}}
      <script>
            function startTime() {
                  var today = new Date();
                  var h = today.getHours();
                  var m = today.getMinutes();
                  var s = today.getSeconds();
                  m = checkTime(m);
                  s = checkTime(s);
                  document.getElementById('realTime').innerHTML =
                  h + ":" + m + ":" + s;
                  var t = setTimeout(startTime, 500);
            }
            function checkTime(i) {
                  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                  return i;
            }
    </script>
</footer>