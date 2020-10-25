<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      {{-- <a href="/" class="logo mr-auto" ><img src="assets/img/logo.jpeg" alt="" class="img-fluid"></a> --}}

      <h1 class="logo mr-auto"><a href="/">Profit Buddies</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav class="nav-menu d-none d-lg-block">
        <ul> 
          @yield('nav')
          
          {{-- <li><label for="search" class="search" id="searchTrigger"><i class="fa fa-search"></i></label></li> --}}
          <li class="active">
            <label for="search" class="search"> <i class="fa fa-search" aria-hidden="true"> </i></label>
            <div class="search-box">
              <form action="{{route('search')}}" method="post"> {{ csrf_field() }}
                <input type="text" name="search" placeholder=""/>
                <input type="submit" value="Search"/>
              </form>
              </div>
          </li>

        </ul>
        <label class="toggleNav" onclick="toggleNav()"><i class="fa fa-bars"></i></label>
      </nav>
      <div class="modal" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="fa fa-times close"></span>
                <h2>Looking for something?</h2>
            </div>
            <div class="modal-body">
                <form action="#" method="get">
                    <input type="search" class="searchbx" name="search" autofocus placeholder="Hit ENTER to search..." id="search">
                </form>
            </div>
        </div>
    </div>
      
      <!-- .nav-menu --> 
      @if (Session::get('uid') == null)
        <a href="/signInForm" class="get-started-btn">Sign In</a>
          
      @else
        <a href="{{route('user_info')}}" class="get-started-btn">Dashboard</a>
        <a href="/signOut" class="get-started-btn">Log Out</a>
      @endif
      

    </div>
  </header><!-- End Header -->

  