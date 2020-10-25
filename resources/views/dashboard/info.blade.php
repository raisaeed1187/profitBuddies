<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.ico" />

    <title>Profit Buddies</title>

    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
      name="viewport"
    />
    <meta name="viewport" content="width=device-width" />

    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="assets/img/apple-icon.png"
    />
    {{-- <link rel="icon" type="image/png" href="dashboard/assets/img/favicon.png" /> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!--     Fonts and icons     -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
    />

    <!-- CSS Files -->

    <link href="dashboard/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="dashboard/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />
    
   
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="dashboard/assets/css/demo.css" rel="stylesheet" />

  </head>

  <body >
    <div
      class="image-container set-full-height"
      style="background-image: url('dashboard/assets/img/wizard-profile.jpg');"
    >
      <!--   Creative Tim Branding   -->
      <a href="/">
        <div class="logo-container">
          {{-- <div class="logo">
            <img src="dashboard/assets/img/new_logo.png" />
          </div> --}}
          <div class="brand">
            Profit Buddies
          </div>
        </div>
      </a>

      <!--  Made With Material Kit  -->
      {{-- <a
        href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard"
        class="made-with-mk"
      >
        <div class="brand">MK</div>
        <div class="made-with">Made with <strong>Material Kit</strong></div>
      </a> --}}

      <!--   Big container   -->
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <!--      Wizard container        -->
            
            <div class="wizard-container">
              <div
                class="card wizard-card"
                data-color="green"
                id="wizardProfile"
              >
                {{-- <form action="" method=""> --}}
                  <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

                  
                  <div class="wizard-navigation">
                    <ul>
                      <li><a href="#about" data-toggle="tab">Profile</a></li>
                      <li><a href="#account" data-toggle="tab">Projects</a></li>
                      <li><a href="#address" data-toggle="tab">Edit Profile</a></li>
                    </ul>
                  </div>

                  <div class="tab-content">
                    <div class="tab-pane" id="about">
                      <div class="row">
                        
                        <div class="col-sm-4 col-sm-offset-1">
                          <div class="picture-container">
                            <div class="picture">
                              <img
                                src="{{$user->data()['profilePictureURL']}}"
                                class="picture-src"
                                id="wizardPicturePreview"
                                title=""
                              />
                            </div>
                            
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">face</i>
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label"
                                >Follower </label
                              >
                              <a href="{{route('show.followers')}}" class="btn btn-fill btn-success btn-wd">{{$followers->size()}}</a>
                              
                      
                            </div>
                          </div>

                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">record_voice_over</i>
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label"
                                >Following </label
                              >
                              <a href="{{route('show.followings')}}" class="btn btn-fill btn-success btn-wd">{{$followings->size()}}</a>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-10 col-sm-offset-1">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">description</i>
                            </span>
                            <div class="form-group label-floating">
                              <label class="control-label"
                                >About Me </label
                              >
                              {{$user->data()['bussinerHistory']}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- end profile tab --}}

                    <div class="tab-pane" id="account">
                     
                      <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                          @foreach ($projects as $project)
                              @if ($project->exists())
                                  
                              <div class="col-sm-6" >
                                <div class="course-item">
                                  <img src="{{$project->data()['picUrl'][0]}}" class="img-fluid" alt="...">
                                  <div class="course-content">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="badge-success rounded" style="padding: 3px;">{{$project->data()['location']}}</h4>
                                      <p class="price">{{$project->data()['totalbudget']}}.{{$project->data()['currency']}}</p>
                                    </div>
                                    <h4><a href="{{$project->id()}}">{{$project->data()['projecttype']}}</a></h4>
                                    <p>{{$project->data()['projectdes']}}</p>
                                    
                                  </div>
                                </div>
                              </div>
                              @endif
                          @endforeach
                          {{-- <div class="col-sm-6">
                            <div class="course-item">
                              <img src="assets/img/course-2.jpg" class="img-fluid" alt="...">
                              <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                  <h4 class="badge-success rounded" style="padding: 3px;">Dubai</h4>
                                  <p class="price">$169</p>
                                </div>
                                <h3><a href="course-details.html">Car Show Room</a></h3>
                                <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                                
                              </div>
                            </div>
                          </div> --}}
                          
                        </div>
                      </div>
                    </div>
                    {{-- end project tab --}}

                    <div class="tab-pane" id="address">
                     <form action="{{route('update.user')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      
                              
                          <div class="row">
                            <div class="col-sm-5">
    
                            </div>
                            <div class="picture-container">
                              <div class="picture">
                                <img
                                  src="{{$user->data()['profilePictureURL']}}"
                                  class="picture-src"
                                  id="wizardPicturePreview"
                                  title=""
                                />
                                <input type="file" name="image" id="wizard-picture" />
                              </div>
                              <h6>Choose Picture</h6>
                            </div>
                          </div>
                          <div class="row">
                            
                            <div class="col-sm-5 col-sm-offset-1">
                              <div class="form-group label-floating">
                                <label class="control-label">First Name</label>
                                <input type="text" value="{{$user->data()['firstName']}}" name="firstName" class="form-control" />
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-group label-floating">
                                <label class="control-label">Last Name</label>
                                <input type="text" value="{{$user->data()['lastName']}}" name="lastName" class="form-control" />
                              </div>
                            </div>
                            <div class="col-sm-10 col-sm-offset-1">
                              <div class="form-group label-floating">
                                <label class="control-label">User Name</label>
                                <input type="text" value="{{$user->data()['userName']}}" name="userName" class="form-control" />
                              </div>
                            </div>
                            <div class="col-sm-5 col-sm-offset-1">
                              <div class="form-group label-floating"> 
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                  <option disabled="" selected="">{{$user->data()['gender']}}</option>
                                  <option value="Male"> Male </option>
                                  <option value="Female"> Female </option>
                                  <option value="Other"> Other </option>
                                  
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-group label-floating">
                                <label >Country</label>
                                <input type="text" class="form-control" name="country" value="{{$user->data()['nationality']}}" disabled >
                                
                              </div>
                            </div>
                            <div class="col-sm-10 col-sm-offset-1">
                              <div class="form-group label-floating">
                                <label class="control-label">Businees History</label>
                                <textarea name="history" class="form-control" id="" cols="30" rows="4">
                                  {{$user->data()['bussinerHistory']}}
                                </textarea>
                              </div>
                            </div>
                            
                          </div>
                          <div class="row">
                            <div class="col-sm-5"></div>
                            <input
                              type="submit"
                              class="btn btn-fill btn-success btn-wd"
                              name="update"
                              value="Update"
                            />
                          </div>
                          
                      
                     </form>
                    </div>
                  </div>
                  {{-- <div class="wizard-footer">
                    <div class="pull-right">
                      <input
                        type="button"
                        class="btn btn-next btn-fill btn-success btn-wd"
                        name="next"
                        value="Next"
                      />
                      <input
                        type="button"
                        class="btn btn-finish btn-fill btn-success btn-wd"
                        name="finish"
                        value="Finish"
                      />
                    </div>

                    <div class="pull-left">
                      <input
                        type="button"
                        class="btn btn-previous btn-fill btn-default btn-wd"
                        name="previous"
                        value="Previous"
                      />
                    </div>
                    <div class="clearfix"></div>
                  </div> --}}
                {{-- </form> --}}
              </div>
            </div>
            <!-- wizard container -->
          </div>
        </div>
        <!-- end row -->
      </div>
      <!--  big container -->

      
    </div>
  </body>
  <!--   Core JS Files   -->
  <script src="dashboard/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
  <script src="dashboard/assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="dashboard/assets/js/jquery.bootstrap.js" type="text/javascript"></script>

  <!--  Plugin for the Wizard -->
  <script src="dashboard/assets/js/material-bootstrap-wizard.js"></script>

  <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
  <script src="dashboard/assets/js/jquery.validate.min.js"></script>

  

</html>
