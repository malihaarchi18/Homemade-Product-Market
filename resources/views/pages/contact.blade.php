@extends('layouts.homepage')
@section('content')
<div class='container margin-top-20'>
	@if(session('mm'))
            <div class="alert alert-success" role="alert">
            {{ session('mm') }}

            </div>

             @endif
<div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="bread"><span>Emart</span> / <span>Contact Us</span></p>
          </div>
        </div>
      </div>
    </div>

    <h2>There's nothing we love to do more than hearing from our customers like you.</h2>


		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Contact Information</h3>
						<div class="row contact-info-wrap">
							<div class="col-md-3">
								<p><span><i class="icon-location"></i></span> Nirala,Khulna<br> Bangladesh</p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1234 5678 90</a></p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@emart.com</a></p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-globe"></i></span> <a href="#">emart.com</a></p>
							</div>
						</div>
					</div>
				</div>
               
                <form action="{{ route('message')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Get In Touch</h3>
							<form action="#" class="contact-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">First Name</label>
											<input type="text" id="fname" class="form-control" placeholder="Your firstname" name="fname" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Last Name</label>
											<input type="text" id="lname" class="form-control" placeholder="Your lastname" name="lname" autocomplete="off">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" id="email" class="form-control" placeholder="Your email address" name="email" autocomplete="off">
										</div>
									</div>

									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="contact_no">Contact No.</label>
											<input type="text" id="email" class="form-control" placeholder="Your Contact Number" name="contact" autocomplete="off">
										</div>
									</div>

									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="subject">Subject</label>
											<input type="text" id="subject" class="form-control" placeholder="Your subject of this message" name="subject" autocomplete="off">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="message">Message</label>
											<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" value="Send Message" class="btn btn-info btn-lg">
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
					<div class="col-md-6">
						<div id="map" class="colorlib-map"></div>		
					</div>
				</div>
			</form>
			</div>
		</div>
</div>

@include('layouts.partial.footer')
@endsection




