@extends('layouts.layout')
@section('content')

{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ----------> --}}

<div class="container-fluid">
	
		<div class="container">
			<div class="formBox">
				<form  action="{{route('store.project')}}" method="post" enctype="multipart/form-data">
					@csrf	
					<div class="row">
							<div class="col-sm-12">
								<h1>Add New Project</h1>
							</div>
						</div>

						

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox ">
									<div class="inputText">Project Title</div>
									<input type="text" name="title" class="input" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox ">
									<div class="inputText">Total Budget</div>
									<input type="number" name="totalbudget" class="input"  min="0" required>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Remaining Budget</div>
									<input type="number" name="remainingbudget" class="input"  min="0" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox">
									<div style="font-size: 18px;opacity: 1;color: #00d4a6;">Pick Currency</div>
									<select name="currency" id="currencies" class="input" id="" required>
										<option value="">Select a Currency</option>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div style="font-size: 18px;opacity: 1;color: #00d4a6;">Location</div>
									<select name="country" id="countries" class="input" id="" required>
										<option value="">Select your location</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Email</div>
									<input type="text" name="email" class="input" required>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Mobile</div>
									<input type="text" name="mobile" class="input" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox">
									<div class="inputText">Project Description</div>
									<textarea class="input" name="description" required></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								
								<div class="picture-container">
									<div class="picture">
									  <img
										src="dashboard/assets/img/grey-background.jpg"
										class="picture-src"
										id="wizardPicturePreview"
										title="" width="400px" height="300px"
									  />
									  <input multiple="multiple" type="file" accept="images/*" required id="upload_titlebar_logo_live" name="image[]" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0" />
								  
									</div>
									<h6>Choose Picture</h6>
								  </div>

								{{-- <div class="inputBox"> --}}
									{{-- <div class="inputText">Upload image</div> --}}
									{{-- <input type="file" name="image"> --}}
								{{-- </div> --}}
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<input type="submit" name="" class="button" value="Save" style="font-size: 18px;">
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
    
<script src="/js/countries.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	 <script type="text/javascript">
	 	$(".input").focus(function() {
	 		$(this).parent().addClass("focus");
	 	})
	 </script>

@endsection
 