 @extends('layouts.layout')

      @section('content')
        
        <!-- ======= Hero Section ======= -->
            <section id="hero" class="d-flex justify-content-center align-items-center">
                <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
                </div>
            </section>
        <!-- End Hero -->

        <!-- ======= Popular Courses Section ======= -->
        <section id="popular-courses" class="courses">
          <div class="container" data-aos="fade-up">
    
            <div class="section-title">
                <h2>Projects</h2>
                <p>Projects For You</p>
            </div>
    
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
        </section>
        <!-- End Popular Courses Section -->
        
        <!-- ======= Trainers Section ======= -->
        <section id="trainers" class="trainers">
            <div class="container" data-aos="fade-up">
    
            <div class="section-title">
                <h2>Following</h2>
                <p>You Are Following</p>
            </div>
    
            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="member">
                    <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                    <h4>Walter White</h4>
                    <span>Web Development</span>
                    <p>
                        Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
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
                </div>
    
            </div>
    
            </div>
        </section>
        <!-- End Trainers Section -->
        
        
    @endsection
 
