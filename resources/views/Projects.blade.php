@extends('layouts.layout')
@section('content')

<main id="main" data-aos="fade-in">

  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="container">
      <h1>Projects</h1>  
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
                  <img src="{{$project->data()['picUrl'][0]}}" style="max-height: 300px;" class="img-fluid" alt="...">
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
                        <img src="{{$user->data()['picUrl']}}" class="img-fluid" alt="">
                        <span>
                          
                          {{$user->data()['firstName']}} {{$user->data()['lastName']}}
                          
                            
                        </span>
                        </div>
                          <div class="trainer-rank d-flex align-items-center">
                              <a href="{{route('follow.user',['id'=>$user->id()])}}" class="get-started-btn">Follow</a>
                          </div>
                        @break
                      @endif {{--condition if --}}
                      @endforeach
                  </div>
                  </div>
              </div>
            </div> <!-- End Course Item-->
            
            @endif
        @endforeach  

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