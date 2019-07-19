@extends('layouts/frontendapp')

@section('frontend_content')


	<!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="{{url('/')}}">Home</a> /
				<span>Contact</span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area contact-page">
		<div class="container spad">
			<div class="text-center">
				<h4 class="contact-title">Get in Touch</h4><br>

				@if(session('mailstatus'))
				<div class="alert alert-success">
					{{session('mailstatus')}}
				</div>
				@endif
			</div>


			<form action="{{url('contact/insert')}}" class="contact-form" method="POST">

				@csrf

				<div class="row">
					<div class="col-md-6">
						<input type="text" name="first_name" placeholder="First Name *"> 
					</div>
					<div class="col-md-6">
						<input type="text" name="last_name" placeholder="Last Name *"> 
					</div>
					<div class="col-md-12">
						<input type="text" name="subject" placeholder="Subject">
						<textarea placeholder="Message" name="message"></textarea>
						<div class="text-center">
							<button type="submit" class="site-btn">Send Message</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="container contact-info-warp">
			<div class="contact-card">
				<div class="contact-info">
					<h4>Shipping & Returnes</h4>
					<p>Phone:    +53 345 7953 32453</p>
					<p>Email:   yourmail@gmail.com</p>
				</div>
				<div class="contact-info">
					<h4>Informations</h4>
					<p>Phone:    +53 345 7953 32453</p>
					<p>Email:   yourmail@gmail.com</p>
				</div>
			</div>
		</div>
		<div class="map-area">
			<div class="map" id="map-canvas"></div>
		</div>
	</div> 
	<!-- Page end -->




@endsection