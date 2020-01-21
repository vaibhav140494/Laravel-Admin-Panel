@include('frontend_user.header')
		
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>About Us</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><span>About Us</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
	<!-- About Page -->
	
	<div class="about_page_area fix">
		<div class="container">
			<div class="row about_inner">
				<div class="about_img_area col-lg-6 col-md-12 col-xs-12">
					<div data-video="NrmMk1Myrxc" id="video">
					  <img src="{{url('frontend/img/screenshot.jpg')}}" alt="Video Screenshot">
					</div>
				</div>
				
				<div class="about_content_area col-lg-6  col-md-12 col-xs-12">
					<h2>Who we are</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat enim ad minim veniam, quis nostrud exercita.</p>
					<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>
				</div>
				
			</div>
			
			<div class="team_area">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="section_title">	
							<span class="sub-title">Meet our Experts</span>
							<h2>Our Team</h2>
							<div class="divider"></div>							
						</div>
					</div>
				</div>	

				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="our-team">
							<div class="pic">
								<img src="{{url('frontend/img/team/1.jpg')}}" alt="">
							</div>
							<div class="team-content">
								<h3 class="title">Williamson</h3>
								<span class="post">web developer</span>
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div><!-- End Col -->

					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="our-team">
							<div class="pic">
								<img src="{{url('frontend/img/team/2.jpg')}}" alt="">
							</div>
							<div class="team-content">
								<h3 class="title">kristina</h3>
								<span class="post">Web Designer</span>
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div><!-- End Col -->				

					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="our-team">
							<div class="pic">
								<img src="{{url('frontend/img/team/3.jpg')}}" alt="">
							</div>
							<div class="team-content">
								<h3 class="title">Steve Thomas</h3>
								<span class="post">Web Designer</span>
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div><!-- End Col -->			
					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="our-team">
							<div class="pic">
								<img src="{{url('frontend/img/team/4.jpg')}}" alt="">
							</div>
							<div class="team-content">
								<h3 class="title">Miranda joy</h3>
								<span class="post">Web Designer</span>
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div><!-- End Col -->
					
				</div>				
				
			</div>
		</div>
	</div>

@include('frontend_user.footer')