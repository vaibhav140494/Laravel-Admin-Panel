@include('frontend_user.header')
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Blog Details</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Fashions fade is eternal</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
				
		<!-- Blog Details Page -->
		<div id="blog_page_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-8 col-xs-12">
						<!-- Single blog -->
						<div class="single_blog">								
							<div class="single_blog_img">
								<img src="{{url('frontend/img/blog/1-full.jpg')}}" alt="">
								<div class="blog_date text-center">
									<div class="bd_day"> 25</div>
									<div class="bd_month">Aug</div>
								</div>
							</div>
						
							<div class="blog_content">
								<ul class="post-meta">
									<li><i class="ti-user"></i> <a href="#">Admin</a></li>									
									<li><i class="ti-comments"></i> <a href="#">2 comments</a></li>
									<li><i class="ti-eye"></i> <a href="#">12 Views</a></li>
								</ul>	
								<div class="blog_details">
									<p>Tattooed Cosby sweater whatever semiotics, Godard Portland VHS viral sustainable bespoke vinyl roof party. Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan Tonx lomo. Tattooed Cosby sweater whatever semiotics, Godard Portland VHS viral sustainable bespoke vinyl roof party. Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over.</p>
									<p>Pour-over Tumblr keffiyeh, cornhole whatever cardigan Tonx lomo. Tattooed Cosby sweater whatever semiotics, Godard Portland VHS viral sustainable bespoke vinyl roof party. Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan Tonx lomo. Tattooed Cosby sweater whatever semiotics, Godard Portland VHS viral sustainable bespoke vinyl roof party.</p>
								</div>							
							</div>							
						</div>		
						<!-- End Single blog -->
						
						<!-- Blog Comments -->
						<div class="row">
							<div class="col-md-12">
								<div class="blog_comment_area">
									<h2 class="comments-title">2 Comments</h2>
									<!-- Blog Comments List -->
									<ul class="comment_inner fix">
										<li>
											<div class="single_cmnt fix">
												<div class="blog_cmnt_img"><img src=" {{url('frontend/img/comment/1.jpg')}}" alt="" /></div>
												<div class="cmnt_content fix">
													<h4>Johns Clark</h4>
													<div class="com_date">2018 2 February</div>
													<a href="#"><i class="fa fa-reply-all"></i></a>
													<p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over..</p>
												</div>
											</div>
											<ul>
												<li>
												<div class="single_cmnt fix">
													<div class="blog_cmnt_img"><img src="{{url('frontend/img/comment/2.jpg')}}" alt="" /></div>
													<div class="cmnt_content fix">
														<h4>Johns Clark</h4>
														<div class="com_date">2018 2 February</div>
														<a href="#"><i class="fa fa-reply-all"></i></a>
														<p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally Wes Anderson ethical four loko.</p>
													</div>
												</div>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							

							<div class="col-md-12">
								<!-- Blog Comments Form -->
								<div class="blog_cmnt_form fix text-left">
									<h2 id="reply-title">LEAVE A COMMENT</h2>
									<form action="#">
										<div class="form-row">
											<div class="col-sm-6">
												<div class="input-area"><input type="text" class="form-control" placeholder="Name*" /></div>												
											</div>	

											<div class="col-sm-6">
												<div class="input-area"><input type="text" class="form-control" placeholder="Email*" /></div>							
											</div>
										</div>
										<div class="input-area"><input type="text" class="form-control" placeholder="Subject" /></div>
										<div class="input-area"><textarea name="message" placeholder="Message"></textarea></div>
										<input class="btn border-btn" type="submit" value="Comment" />
									
									</form>
								</div>				
							</div>
											
						</div>
					</div>
				
					<!-- Blog Sidebar -->
					<div class="col-md-4 col-xs-12">							
						<div class="single_sidebar search_widget">
							<h3 class="sdbr_title">Search</h3>
							<div class="sdbr_inner">
								<form class="search_form" method="post" action="#">
									<input type="text" class="form-control search_input" name="s" id="s" placeholder="Search Here ...">
									<button type="submit" class="search_button"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>
						
						<div class="single_sidebar category">
							<h3 class="sdbr_title">categories</h3>
							<div class="sdbr_inner">
							<!-- treeview start -->
								<ul>
									<li><a href="#">Women</a></li>
									<li><a href="#">Men</a></li>
									<li><a href="#">Kids</a></li>
									<li><a href="#">Jewelry</a></li>
									<li><a href="#">Accessories</a></li>
									<li><a href="#">Trends</a></li>
								</ul>
							</div>
						</div>

						<div class="single_sidebar popular_post">
							<h3 class="sdbr_title">popular post</h3>
							<div class="sdbr_inner">
								<div class="single_popular_post fix">
									<a href="#" class="spp_img"><img src=" {{url('frontend/img/sidebar/1.jpg')}}" alt="" /></a>
									<div class="spp_text fix">
										<a href="#">Lorem Ipsum is simply 2018.</a>
										<p>Posted By John Doe</p>
									</div>
								</div>
								<div class="single_popular_post fix">
									<a href="#" class="spp_img"><img src="{{url('frontend/img/sidebar/2.jpg')}}" alt="" /></a>
									<div class="spp_text fix">
										<a href="#">Lorem Ipsum is simply 2018.</a>
										<p>Posted By John Doe</p>
									</div>
								</div>
								<div class="single_popular_post fix">
									<a href="#" class="spp_img"><img src="{{url('frontend/img/sidebar/3.jpg')}}" alt="" /></a>
									<div class="spp_text fix">
										<a href="#">Lorem Ipsum is simply 2018.</a>
										<p>Posted By John Doe</p>
									</div>
								</div>
							</div>
						</div>
											
						<div class="single_sidebar tags fix">
							<h3 class="sdbr_title">tags</h3>
							<div class="sdbr_inner">
								<a href="#">App</a>
								<a href="#">Fashiondary</a>
								<a href="#">Fashion Tag</a>
								<a href="#">Logo Designer</a>
								<a href="#">Populat Tees</a>
								<a href="#">Designer</a>
								<a href="#">Most Recent</a>
							</div>
						</div>
					</div><!-- End Blog Sidebar -->
					
				</div>					
			</div>
		</div>
    @include('frontend_user.footer')
