@include('frontend_user.header')

		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
					
						<h3> Category : {{$categories['category_name']}}</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
							<li><a href="{{route('frontend.category.list')}}">{{$categories['category_name']}}</a></li>
							<li><span>Subcategories</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
				
		<!-- Blog Page -->
		<div id="blog_page_area">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						<!-- Single blog -->
						<div class="single_blog">
							<div class="single_blog_img">
								<a href="#"><img src=" {{url('frontend/img/blog/1-full.jpg')}}" alt=""></a>
								<div class="blog_date text-center">
									
								</div>
							</div>
												
							<div class="blog_content">
								<ul class="post-meta">
									<li><i class="ti-eye"></i> <a href="#">{{$subcategory->count()}} Subcategories</a></li>
								</ul>										
							
								<h4 class="post_title"><a href="#">{{$categories['category_name']}}</a> </h4>															
								<p>
									{{$categories['category_desc']}}
								
								</p>
							</div>
						</div>
						<!-- End Single blog -->			

						<!-- Single blog -->
						<!-- <div class="single_blog">
							<div class="single_blog_img">
								<a href="#"><img src="{{url('frontend/img/blog/2-full.jpg')}}" alt=""></a>
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
							
								<h4 class="post_title"><a href="#">Integer euismod dui non auctor</a> </h4>															
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing 
									elit. Praesent vel elit et lectus pulvinar dignissim.
									Fusce mattis scelerisque elit, sed vulputate lectus suscipit sed. 
									Cras viverra nisi nec nisi volutpat, nec suscipit elit euismod. 
									Mauris convallis auctor tristique. 
									Maecenas sit amet pulvinar turpis....
								
								</p>
							</div>
						</div> -->
						<!-- End Single blog -->				
					
						<!-- <div class="blog_pagination pgntn_mrgntp fix">
							<div class="pagination text-center">
								<ul>
									<li><a href="#"><i class="fa fa-angle-left"></i></a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#" class="active">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
								</ul>
							</div>
						</div>	 -->
					</div>
				
					<!-- Blog Sidebar -->
					<div class="col-md-4 col-xs-12">							
						<div class="single_sidebar search_widget">
							<h3 class="sdbr_title">Search</h3>
							<div class="sdbr_inner">
								<form class="search_form" >
									<input type="text" class="form-control search_input" name="search" id="search" placeholder="Search Sub categories ...">
									<button type="submit" class="search_button"><i class="fa fa-search"></i></button>
								</form>
								
							</div>
						</div>
						
						<div class="single_sidebar category">
							<h3 class="sdbr_title"> Subcategories</h3>
							<div class="sdbr_inner">
							<!-- treeview start -->
								<ul class="show">
								<?php $cid=$categories['id'];
								?>
									@if($subcategory->count()>0)
										@foreach ($subcategory as $sub)
										<?php $id = $sub->id; ?>
										<li><a href="{{route('frontend.products.list',[$id,$cid])}}">{{$sub->subcategory_name}}</a></li>
										@endforeach
									@else
										Sorry No subcategory found!!!
									@endif
								</ul>
							</div>
						</div>

						<!-- <div class="single_sidebar popular_post">
							<h3 class="sdbr_title">popular post</h3>
							<div class="sdbr_inner">
								<div class="single_popular_post fix">
									<a href="#" class="spp_img"><img src=" {{url('frontend/img/sidebar/1.jpg')}}" alt="" /></a>
									<div class="spp_text fix">
										<a href="#">Lorem Ipsum is simply 2019.</a>
										<p>Posted By John Doe</p>
									</div>
								</div>
								<div class="single_popular_post fix">
									<a href="#" class="spp_img"><img src="{{url('frontend/img/sidebar/2.jpg')}}" alt="" /></a>
									<div class="spp_text fix">
										<a href="#">Lorem Ipsum is simply 2019.</a>
										<p>Posted By John Doe</p>
									</div>
								</div>
								<div class="single_popular_post fix">
									<a href="#" class="spp_img"><img src="{{url('frontend/img/sidebar/3.jpg')}}" alt="" /></a>
									<div class="spp_text fix">
										<a href="#">Lorem Ipsum is simply 2019.</a>
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
						</div> -->
					</div><!-- End Blog Sidebar -->
					
				</div>							
			</div>
		</div>

	<script type="text/javascript">
	$(document).ready(function(){
		var append1 =$('.show').html();
		$('#search').keyup(function(){
			console.log(append1);
			if($(this).val()=='')
			{
				$('.show').html(append1);
			}	
			var str=$(this).val();
			var cid=<?php echo $categories['id']; ?>;
			$.ajax({
				url:"{{route('frontend.subcategory.list.ajax')}}",
				method:'get',
				dataType:'json',
				data:{'str':str,'id':id},
				success: function(response)
				{
					// console.log(response);
					if(response['success'])
					{
						
						cat=response['data'];
						
						console.log(cat);
						var li1='';
						$.each(cat,function(key,value){
							var id=value.id;
							var route="{{route('frontend.products.list',['id'=>"+id+","+cid+"])}}";
							console.log(route);
							var splitarr=route.split('/');
							splitarr[splitarr.length-1]=id;
							console.log(splitarr);
							route1=splitarr[splitarr.length-2]+'/'+splitarr[splitarr.length-1];
							li1 +='<li><a href="http://127.0.0.1:8000/'+route1+'">'+cat[key].subcategory_name+'</a></li>';
							console.log(li1);
						});	
						$('.show').html(li1);

					}
					else
					{
						$('.show').html(response['error']);
					}
					
				}
				
			});
			

		});
	});
	</script>
@include('frontend_user.footer')