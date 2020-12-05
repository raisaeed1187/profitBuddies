<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      {{-- <a href="/" class="logo mr-auto" ><img src="assets/img/logo.jpeg" alt="" class="img-fluid"></a> --}}

      <h1 class="logo mr-auto"><a href="/">Profit Buddies</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <nav class="nav-menu d-none d-lg-block">
        <ul>  
          
            @yield('nav')
            <li><button class="openSearchBtn" onclick="openSearch()"><i class="fa fa-search"></i></button></li>
            {{-- <li><a href="#search" class="search"><i class="fa fa-search"></i></a></li> --}}
            {{-- <li><label for="search" class="search" id="searchTrigger"><i class="fa fa-search"></i></label></li> --}}
            
            {{-- <li class="active">
              <label for="search" class="search"> <i class="fa fa-search" aria-hidden="true"> </i></label>
              <div class="search-box">
      
                <form action="{{route('search')}}" method="post"> {{ csrf_field() }}
                  <input type="text" name="search" placeholder=""/>
                  <input type="submit" value="Search"/>
                </form>
                </div>
            </li> --}}
  
            @if (Session::get('uid') == null)
            <li> <a href="/signInForm" style="color: white;" class="get-started-btn">Sign In</a></li>
              
          @else
            <li><a href="{{route('user_info')}}" style="color: white;"  class="get-started-btn">Dashboard</a></li>
           <li> <a href="/signOut" style="color: white;" class="get-started-btn">Log Out</a></li>
          @endif
          {{-- <li>
            <div class="search-container">
              <form action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
          </li> --}}
          </ul>
          <label class="toggleNav" onclick="toggleNav()"><i class="fa fa-bars"></i></label>
          {{-- <div class="close-btn">
            <span class="fas fa-times"></span>
          </div>
      <div class="wrapper">
            <div class="search-btn">
              <span class="fas fa-search"></span>
            </div>
      <div class="search-data">
              <input type="text" required>
              <div class="line">
      </div>
      <label>Type to search..</label>
              <span class="fas fa-search"></span>
            </div>
      </div> --}}
          
          {{-- <label class="toggleNav" onclick="toggleNav()"><i class="fa fa-bars"></i></label> --}}
        </nav>
      
      <div id="mylayout" class="layout">
        <span class="layoutclosebtn" onclick="closeSearch()" title="Close layout">×</span>
        <div class="layout-content">
          <a href="{{route('home')}}">Test it</a>
          <form action="http://nicesnippets.com" target="_blank">
              <input type="text" placeholder="Search.." name="search">
              <button type="submit" class="searchBtn"><i class="fa fa-search "></i></button>
          </form>
        </div>
    </div>
      <div id="search">
        <button type="button" style="background-color:#5fcf80; " class="close">×</button>
        <form action="{{route('search')}}" target="_blank" method="post">{{ csrf_field() }}
            <input type="search" name="search" placeholder="type keyword(s) here" />
            <input type="submit" class="btn get-started-btn searchBtn" value="Search" style="font-size: 30px;">
        </form>
    </div>
      {{-- <div class="modal" id="modal">
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
    </div> --}}
      

    </div>
  </header><!-- End Header -->

  