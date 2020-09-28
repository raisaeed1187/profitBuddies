<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="/">Profit Buddies</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="/">Home</a></li>
          <li><a href="{{route('projects')}}">Projects</a></li>
          <li><a href="{{route('following')}}">Following</a></li>
          <li><a href="{{route('add_project')}}">Add Project</a></li>
          

        </ul>
      </nav><!-- .nav-menu -->

      <a href="{{route('user_info')}}" class="get-started-btn">Dashboard</a>
      <a href="/signOut" class="get-started-btn">Log Out</a>

    </div>
  </header><!-- End Header -->

  