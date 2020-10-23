@extends('layouts.layout')
@section('content')

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h1>Project Details</h1>
       
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">
        
        <div class="row"> 
          
          <div class="col-lg-8">
            {{-- <img src="assets/img/course-1.jpg" class="img-fluid" alt=""> --}}

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                {{-- @foreach ($project->data()['picUrl'] as $url) --}}
                    
                <div class="carousel-item active"> 
                  <img class="d-block w-100" src="{{$project->data()['picUrl'][0]}}" alt="First slide">
                </div>
                {{-- @endforeach --}}
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{$project->data()['picUrl'][1]}}" alt="Second slide">
                </div>
                {{-- <div class="carousel-item">
                  <img class="d-block w-100" src="assets/img/course-2.jpg" alt="Third slide">
                </div> --}}
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

            <h3>{{$project->data()['projecttype']}}</h3>
            <h4>
              {{$project->data()['projectdes']}}  
            </h4>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Project Title</h5>
              <h5><a href="#">{{$project->data()['projecttype']}}</a></h5>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Budget</h5>
              <h5>{{$project->data()['totalbudget']}}.{{$project->data()['currency']}}</h5>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Remaining</h5>
              <h5>{{$project->data()['remainbudget']}}</h5>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Contact</h5>
              <h5>{{$project->data()['contact']}}</h5>
            </div>
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Location</h5>
              <h5>{{$project->data()['location']}}</h5>
            </div>
            {{-- <div style="float: right;" class="trainer-rank d-flex align-items-center f-right">
              <a href="{{route('follow.project',['id'=>$project->data()['userId']])}}" class="get-started-btn">Follow</a>
            </div>  --}}

          </div>
        
        </div>
        
      </div>
    </section><!-- End Cource Details Section -->

    
      <div class="row" style="color: black;">
          <div class="col-sm-10 col-sm-offset-1" id="logout" style="margin-bottom: 20px;">
            <div class="page-header">
                <h1 class="reviews">Leave your comment</h1>
                
            </div>
            @if (Session::has('uid'))                
              <div class="comment-tabs">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#add-comment" role="tab" data-toggle="tab"><h2 class="reviews text-capitalize">Add comment</h2></a></li>
                    <li ><a href="#comments-logout" role="tab" data-toggle="tab"><h2 class="reviews text-capitalize">Comments</h2></a></li>
                  </ul>            
                  <div class="tab-content">
                      <div class="tab-pane " id="comments-logout">                
                          <ul class="media-list">
                            @foreach ($comments as $comment)
                              @if ($comment->exists())

                                  
                              <li class="media">
                                @foreach ($users as $user)
                                    @if ($comment->data()['commentFrom'] == $user->id())
                                    <a class="pull-left" href="#">
                                      <img class="media-object img-circle" src="{{$user->data()['profilePictureURL']}}" alt="profile">
                                    </a>
                                    @break
                                    @endif
                                @endforeach
                                <div class="media-body">
                                  <div class="well well-lg">
                                    @foreach ($users as $user)
                                    @if ($comment->data()['commentFrom'] == $user->id())
                                    
                                    <h2 class="media-heading text-uppercase reviews">{{$user->data()['firstName']}} {{$user->data()['lastName']}}</h2>
                                    @break
                                    @endif
                                @endforeach
                                      <ul class="media-date text-uppercase reviews list-inline">
                                        <li class="dd">22</li>
                                        <li class="mm">09</li>
                                        <li class="aaaa">2014</li>
                                      </ul>
                                      <h4 class="media-comment">
                                        {{$comment->data()['comment']}}
                                      </h4>

                                      <p id="message"></p>
                                  </div>              
                                </div>
                                
                              </li>          
                              @endif
                                
                            @endforeach
                            
                            
                          </ul> 
                      </div> 
                      <div class="tab-pane active" id="add-comment">
                          <form action="{{route('comment')}}" id="comment" method="post" class="form-horizontal" role="form"> 
                            @csrf 
                            <input type="hidden" name="postId" value="{{$project->id()}}">
                            <div class="form-group">
                                  <h3 for="email" class="col-sm-2 control-label">Comment</h3>
                                  <div class="col-sm-10">
                                    <textarea class="form-control" style="font-size: 18px;" name="comment" id="addComment" rows="5"></textarea>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">                    
                                      <button class="btn btn-success btn-circle text-uppercase" style="font-size:18px;" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                  </div>
                              </div>            
                          </form>
                      </div>
                      
                  </div>
              </div>
            @else
              <div class="alert alert-info">
                <h1>Please Sign In to leave your comment </h1>
              </div>
            @endif
          </div>
      </div>
      
    
 

</main>
  <!-- End #main -->
  {{-- <script>
    // alert('slam');
    var form = document.getElementById('comment');
    var request = new XMLHttpRequest();

    form.addEventListener('submit',function(e){
      e.preventDefault();
      var formData = new FormData(form);
      request.open('post','/comment');
      request.addEventListener('load',transferComplate);
      request.send(formData);
    });

    function transferComplate(data) {
      response JSON.parse(data.currentTarget.response);
      if (response.success) {
        // alert('comment send');
        document.getElementById('message').innerHTML('ajax work');
      }
    }

  </script> --}}
@endsection