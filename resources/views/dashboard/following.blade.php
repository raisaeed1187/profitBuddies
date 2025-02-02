@extends('layouts.layout')
@section('nav')
            <li ><a href="/">Home</a></li>
          <li ><a href="{{route('projects')}}">Projects</a></li>
          <li class="active"><a href="{{route('show.followings')}}">Following</a></li>
          <li><a href="{{route('add_project')}}">Add Project</a></li>
    
@endsection()
@section('content')

<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h1>Followings</h1>
      </div>
    </div><!-- End Breadcrumbs -->
    
    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          @if (count($users) > 0)
              
          
          @foreach ($users as $user)
              @if ($user->exists())
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="member">
                  <img src="{{$user->data()['profilePictureURL']}}" class="img-fluid" alt="">
                  <div class="member-content">
                    <h4>{{$user->data()['firstName']}} {{$user->data()['lastName']}}</h4>
                    <span>Web Development</span>
                    <p>
                      {{$user->data()['bussinerHistory']}}
                    </p>
                    <div class="social">
                      <a href=""><i class="icofont-twitter"></i></a>
                      <a href=""><i class="icofont-facebook"></i></a>
                      <a href=""><i class="icofont-instagram"></i></a>
                      <a href=""><i class="icofont-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4"></div>
                    <div class="trainer-rank d-flex align-items-center">
                      <a href="{{route('unfollow.user',['id'=>$user->id()])}}" class="get-started-btn">Unfollow</a>
                  </div>
                  </div>
                </div>
              </div>
              @endif              
          @endforeach
          @else
              <h4>No Followers Yet</h4>
          @endif

          {{-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Sarah Jhinson</h4>
                <span>Marketing</span>
                <p>
                  Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                </p>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>William Anderson</h4>
                <span>Content</span>
                <p>
                  Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                </p>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div> --}}

        </div>

      </div>
    </section><!-- End Trainers Section -->

  </main><!-- End #main -->

@endsection