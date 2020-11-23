@extends('layouts.layout')
@section('nav')
            <li ><a href="/">Home</a></li>
          <li ><a href="{{route('projects')}}">Projects</a></li>
          <li class="active"><a href="{{route('following')}}">Following</a></li>
          <li><a href="{{route('add_project')}}">Add Project</a></li>
    
@endsection()
@section('content')

<main id="main" data-aos="fade-in">

  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="container">
      <h1>Following Projects</h1>  
    </div>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Courses Section ======= -->
  <section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
    
      <div class="row" data-aos="zoom-in" data-aos-delay="100">

                @foreach ($projects as $project)
                  @if ($project->exists())
                   
                  <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <img src="{{$project->data()['picUrl'][0]}}" style="max-height: 300px"  class="img-fluid" alt="...">
                        <div class="course-content">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>{{$project->data()['location']}}</h4>
                            <p class="price">${{$project->data()['totalbudget']}}</p>
                        </div>
        
                        <h3><a href="{{$project->id()}}">{{$project->data()['projecttype']}}</a></h3>
                        <p>{{$project->data()['projectdes']}}</p>
                        <div class="trainer d-flex justify-content-between align-items-center">
                            <div class="trainer-profile d-flex align-items-center">
                            @foreach ($users as $user)
                            @if ($project->data()['userId'] == $user->id())
                            <img src="{{$user->data()['profilePictureURL']}}" class="img-fluid" alt="">
                            <span>
                              
                              {{$user->data()['firstName']}} {{$user->data()['lastName']}}
                              
                            </span>
                            </div>
                            @break
                            @endif {{--condition if --}}
                            @endforeach
                        </div> 
                        </div>
                    </div>
                  </div> <!-- End Course Item-->
                    
                      {{-- @continue --}}
                      {{-- @break --}}
                    
                  
                  @endif
                @endforeach  

        {{-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
              <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Dubai</h4>
                  <p class="price">$169</p>
              </div>

              <h3><a href="{{route('project')}}">Car Show Room</a></h3>
              <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                  <span>Antonio</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                      <a href="courses.html" class="get-started-btn">Follow</a>
                  </div>
              </div>
              </div>
          </div>
        </div> <!-- End Course Item--> --}}

        {{-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
          <div class="course-item">
              <img src="assets/img/course-2.jpg" class="img-fluid" alt="...">
              <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Islamabad</h4>
                  <p class="price">$250</p>
              </div>

              <h3><a href="course-details.html">Web Application</a></h3>
              <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <img src="assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
                  <span>Lana</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                      <a href="courses.html" class="get-started-btn">Follow</a>
                  </div>
              </div>
              </div>
          </div>
        </div> <!-- End Course Item--> --}}

        {{-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="course-item">
              <img src="assets/img/course-3.jpg" class="img-fluid" alt="...">
              <div class="course-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>London</h4>
                  <p class="price">$180</p>
              </div>

              <h3><a href="course-details.html">Copywriting</a></h3>
              <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
              <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
                  <span>Brandon</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                      <a href="courses.html" class="get-started-btn">Follow</a>
                  </div>
              </div>
              </div>
          </div>
        </div> <!-- End Course Item--> --}}

      </div>

    </div>
  </section><!-- End Courses Section -->

</main><!-- End #main -->
@endsection