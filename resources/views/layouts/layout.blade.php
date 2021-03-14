<!doctype html>
<html lang="en">
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
  {{-- <link href="assets/img/favicon.png" rel="icon"> --}}
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File --> 
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('css/form.css')}}" rel="stylesheet">
  
  {{-- comment style --}}
  <link href="{{asset('css/comment.css')}}" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">         
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Profit Buddies</title>
  </head>
  <body>
    @include('includes.navbar')
 <div>
  @yield('content')
 </div>
<!-- ======= Footer ======= -->
<footer id="footer">

  <div class="container d-md-flex py-4">

    <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
           &copy; Copyright <strong><span>Profit Buddies</span></strong>. All Rights Reserved
        </div>
        
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
      <strong><span>Also on</span></strong>
        <a href="#" class="android"><i class="bx bxl-android"></i></a>
        <strong><span>and</span></strong>
        <a href="#" class="apple"><i class="bx bxl-apple"></i></a>
        {{-- <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
    </div>
    
   </div>
</footer><!-- End Footer -->

{{-- @include('sweetalert::alert') --}}


<a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
<div id="preloader"></div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  
  {{-- comment script --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  {{-- -----sweetalert--------- --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('sweetalert2.all.min.js')}}"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

  <script>
    
    
    
    @if(Session::has('success'))
                
          Swal.fire({
            title:"{{Session::get('success')}}",
            confirmButtonText: 'OK',
            confirmButtonColor: '#3ac162',
          });

     @endif


    //  Swal.fire('Any fool can use a computer');

    $('.nav-menu').on('click','li',function(){
      // alert('slam');
      $('.nav-menu li.active').removeClass('active');
      $(this).addClass('active');
    });
  </script>



<script>
  $(".search-btn").click(function(){
    $(".wrapper").addClass("active");
    $(this).css("display", "none");
    $(".search-data").fadeIn(500);
    $(".close-btn").fadeIn(500);
    $(".search-data .line").addClass("active");
    setTimeout(function(){
      $("input").focus();
      $(".search-data label").fadeIn(500);
      $(".search-data span").fadeIn(500);
    }, 800);
  });
  $(".close-btn").click(function(){
    $(".wrapper").removeClass("active");
    $(".search-btn").fadeIn(800);
    $(".search-data").fadeOut(500);
    $(".close-btn").fadeOut(500);
    $(".search-data .line").removeClass("active");
    $("input").val("");
    $(".search-data label").fadeOut(500);
    $(".search-data span").fadeOut(500);
  });
  $("#completeBt").click(function(){
    alert('slam');
            var _self = $(this);
            var id = _self.attr('rel');
            var userId = _self.data("user");
            var product_name = _self.data("product");
            var link = _self.data("link");
            var retailer = _self.data("retailer");
            var price = _self.data("price");

            console.log("id: "+id +' user id =>'+userId+ " product: "+product_name+" link: "+link +" retailer: "+retailer+" price: "+price);
            if($(this).prop("checked")==true){
               $.ajax({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'post',
                  url : '/admin/update-status',
                  data : {status:1,id:id,user_id:userId,product_name:product_name,link:link,retailer:retailer,price:price}, 
                  success:function(data){
                     $("#message_success").show();
                     setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000);
                  },error:function(){
                     alert("Error");
                  }
               });
  
            }else{
              $.ajax({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'post',
                  url : '/admin/update-status',
                  data : {status:0,id:id,user_id:userId,product_name:product_name,link:link,retailer:retailer,price:price},
                  success:function(resp){
                     $("#message_error").show();
                     setTimeout(function() { $("#message_error").fadeOut('slow'); }, 2000);
                  },error:function(){
                     alert("Error");
                  }
               });
            }
           });
         //Update Product Status
         
</script>

  <script>
    $(document).ready(function() {
      // Swal.fire({
      //   title:"Here's a title!",
      //   confirmButtonText: 'OK',
      //   confirmButtonColor: '#3ac162',
      // });
      // alert('document');
      
        //  $('.layout-content').click(function(){
        //       return false;
        //   });
          $('.layout-content').click(function(e){
            if($(e.srcElement).is(':submit'))
                    return true;
            else return false;
          });

     $(".search").click(function() {
        $(".search-box").toggle();
        $("input[type='text']").focus();
      });

      $(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    }); 
    
    //Do not include! This prevents the form from submitting for DEMO purposes only!
    $('form').submit(function(event) {
        event.preventDefault();
        return false;
    })
});  
  });
  </script>
  <script>
    

    function openSearch() {
    document.getElementById("mylayout").style.display = "block";
}
function closeSearch() {
    document.getElementById("mylayout").style.display = "none";
}
  </script>
  <script>
    var modal = document.getElementById("modal");
    var trigger = document.getElementById("searchTrigger");
    var close = document.getElementsByClassName("close")[0];
    
    trigger.onclick = function ()
    {
        modal.style.display = "block";
    }
    close.onclick = function ()
    {
        modal.style.display = "none";
    }
    window.onclick = function (event)
    {
        if(event.target == modal)
        {
            modal.style.display = "none";
        }
    }

    function toggleNav() {
        var e = document.getElementById("navigation");
        e.classList.toggle("active");
        
    }
   
</script>
@yield('javascript')
  </body>
</html>