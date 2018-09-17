@extends('master')


@section('content')
	<h1>User Registration</h1>
	<div class="row">
		<div class="col-sm">

			<form action="/" method="post" class="register-form" data-submit="registerUser">
				<div class="form-group row">
					<label for="email" class="col-sm-4 col-form-label text-right">Email address</label>
					<div class="col-sm-8">
						<input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
					</div>
					<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
				<div class="form-group row">
					<label for="password" class="col-sm-4 col-form-label text-right">Password</label>
					<div class="col-sm-8">
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="password_c" class="col-sm-4 col-form-label text-right">Confirm Password</label>
					<div class="col-sm-8">
						<input type="password" name="password_confirmation" id="password_c" class="form-control" placeholder="Confirm Password" required>
					</div>
				</div>
				<hr>
				<div class="form-group row">
					<label for="name" class="col-sm-4 col-form-label text-right">Name</label>
					<div class="col-sm-8">
						<input type="name" name="name" id="name" class="form-control" placeholder="Name" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="dob" class="col-sm-4 col-form-label text-right">Date of Birth</label>
					<div class="col-sm-8">
						<input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth" required>
					</div>
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-primary text-right">Register</button>
				</div>
			</form>
		</div>
		<div class="col-sm">
			<div class="card">
				<div class="card-body">
					Move the needle staff engagement, so back of the net wheelhouse minimize backwards overflow, 
					so bottleneck mice. Enough to wash your face push back proceduralize, so can we take this offline, 
					yet best practices wheelhouse. Peel the onion into the weeds value prop, due diligence, 
					nor who's responsible for the ask for this request?. 
					Win-win-win highlights player-coach driving the initiative forward baseline the procedure and 
					samepage your department, but bells and whistles, but shotgun approach.
					<br><br>
					What is a hamburger menu. Something summery; colourful needs to be sleeker, for low resolution? 
					It looks ok on my screen, and can you pimp this powerpoint, need more geometry patterns so is this 
					Can you make it pop make it pop, so we don't need a backup, it never goes down! 
					Just do what you think. I trust you, but I have printed it out.
					So i love it, but can you invert all colors? so i cant pay you . 
					Can't you just take a picture from the internet?. Can we try some other colours maybe give us a complimentary logo along with the website.				</div>
			</div>
		</div>
	</div>
@endsection