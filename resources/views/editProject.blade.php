@extends('layouts.layout')
@section('nav')
            <li ><a href="/">Home</a></li>
          <li ><a href="{{route('projects')}}">Projects</a></li>
          <li><a href="{{route('show.followings')}}">Following</a></li>
          <li ><a href="{{route('add_project')}}">Add Project</a></li>
    
@endsection()
@section('content')

{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ----------> --}}

<div class="container-fluid">
	
		<div class="container">
			<div class="formBox">
				<form  action="{{route('edit_project',['id'=>$project->id()])}}" method="POST" enctype="multipart/form-data">
					@csrf	
					<div class="row">
							<div class="col-sm-12">
								<h1>Edit Project</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
                                <div class="inputBox ">
                                    <div style="font-size: 18px;opacity: 1;color: #00d4a6;">Project Title</div>
									<input type="text" name="title" value="{{$project->data()['projecttype']}}" class="input" required>
								</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inputBox">
                                    <div style="font-size: 18px;opacity: 1;color: #00d4a6;">Email</div>
									<input type="text" name="email" value="{{$project->data()['contact']}}" class="input" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
                                <div class="inputBox ">
                                    <div style="font-size: 18px;opacity: 1;color: #00d4a6;">Total Budget</div>
									<input type="number" name="totalbudget" value="{{$project->data()['totalbudget']}}" class="input"  min="0" required>
								</div>
							</div>

							<div class="col-sm-6">
                                <div class="inputBox">
                                    <div style="font-size: 18px;opacity: 1;color: #00d4a6;">Remaining Budget</div>
									<input type="number" name="remainingbudget" value="{{$project->data()['remainbudget']}}" class="input"  min="0" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox">
									<div style="font-size: 18px;opacity: 1;color: #00d4a6;">Pick Currency</div>
									<input type="text" name="currency2" value="{{$project->data()['currency']}}" class="input" required disabled>
									<input type="hidden" name="currency" value="{{$project->data()['currency']}}">
									{{-- <select name="currency" id="currencies" class="input" required>
                                        <option value="" selected>{{$project->data()['currency']}}</option>
										<option value="">Select a Currency</option>
									</select> --}}
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div style="font-size: 18px;opacity: 1;color: #00d4a6;">Location</div>
									<input type="text" name="country2" value="{{$project->data()['location']}}" class="input" required disabled>
									<input type="hidden" name="country" value="{{$project->data()['location']}}">
									{{-- <select name="country" id="countries" class="input" required>
                                        <option value="" selected>{{$project->data()['location']}}</option>
                                        <option value="">Select your location</option>
									</select> --}}
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-sm-12">
                                <div class="inputBox">
                                    <div style="font-size: 18px;opacity: 1;color: #00d4a6;">Project Description</div>
									<textarea class="input" name="description"  required>{{$project->data()['projectdes']}}</textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								
								<div class="picture-container">
									
									<div class="picture">
									  {{-- <img
										src="dashboard/assets/img/grey-background.jpg"
										class="picture-src"
										id="wizardPicturePreview"
										title="" width="400px" height="300px"
									  />
									  <input multiple="multiple" type="file" accept="images/*" required id="upload_titlebar_logo_live" name="image[]" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0" /> --}}
									  	
											<div class="photo-row">
												<div class="photo-img" id="image_user"
													style="background-image:url('{{$project->data()['picUrl'][0]}}');">
												</div>
												<div class="profile-content">
													<div>
														<label class="change-photo btn btn-success" id="uploadBtn" for="profile_pic">Upload Photo</label>
														<input onchange="doAfterSelectImage(this)" type="file" style="display: none;" id="profile_pic"
															name="image[]" />
													</div><br>
													<div id="addBtn">

													</div>
													

												</div>
									
											</div>
									</div>
								  </div>

								{{-- <div class="inputBox"> --}}
									{{-- <div class="inputText">Upload image</div> --}}
									{{-- <input type="file" name="image"> --}}
								{{-- </div> --}}
							</div>
							<div class="col-6" id="moreImage">

							</div>
						</div>
						@foreach ($project->data()['picUrl'] as $item)
						<input type="hidden" name="oldImages[]" value="{{$item}}" >
						@endforeach
						<input type="hidden" name="timestemp" value="{{$project->data()['timestamp']}}">

						<div class="row">
							<div class="col-sm-12">
								{{-- <button type="submit" class="button">Update</button> --}}
								<input type="submit" class="button" value="Update" style="font-size: 18px;">
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>

	@section('javascript')


<script>
	function doAfterSelectImage2(input) {
        readURL2(input);
        // uploadUserProfileImage();
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader2 = new FileReader();
            reader2.onload = function (e) {
                $('#image2_user').css('background-image', 'url(' + e.target.result + ')');
            };
            reader2.readAsDataURL(input.files[0]);
			
		}
    }
    function doAfterSelectImage(input) {
        readURL(input);
        // uploadUserProfileImage();
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_user').css('background-image', 'url(' + e.target.result + ')');
            };
            reader.readAsDataURL(input.files[0]);
			var addBtn = document.getElementById('addBtn');
			addBtn.innerHTML= `<label id="addMore" class="btn btn-info" >Add More</label>`;
        }
    }
	
	
	var addBtn = document.getElementById('addBtn');
	var moreImage = document.getElementById('moreImage');
 	addBtn.onclick = function() {
		// alert('slam');
		addBtn.innerHTML= ``;
		moreImage.innerHTML =`	
								<div class="picture-container">
									
									<div class="picture">
									  
									  	
											<div class="photo-row2">
												<div class="photo-img2" id="image2_user"
													style="background-image:url('{{ asset('assets/img/car-.png') }}');">
												</div>
												<div class="profile-content2">
													<div>
														<label class="change-photo2 btn btn-success" for="profile_pic2">Upload Photo</label>
														<input onchange="doAfterSelectImage2(this)" type="file" style="display: none;" id="profile_pic2"
															name="image[]" />
													</div><br>
													<div id="addBtn">

													</div>
													

												</div>
									
											</div>
									
									</div>
								  </div>
								`;
	}
	
 	
    function uploadUserProfileImage() {
        let myForm = document.getElementById('user_save_profile_form');
        let formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            url: '{{route('save.profile.picture')}}',
            success: function (response) {
                if (response == 200) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Profile Saved Successfully.');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (response == 700) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('An error occured. Please try later');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }.bind($(this))
        });
    }
</script>

    
<script src="/js/countries.js"></script>
     <script type="text/javascript">
	 	$(".input").focus(function() {
	 		$(this).parent().addClass("focus");
	 	});
		//  $("#uploadBtn").click(function() {
	 	// 	alert('slam');
	 	// });
	 </script>

@endsection
@endsection
 