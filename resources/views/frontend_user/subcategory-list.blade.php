@include('frontend_user.header')


		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						@if($categories)
							<h3> Category : {{$categories['category_name']}}</h3>
						@endif
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
							@if($categories)
								<li><a href="{{route('frontend.category.list')}}">{{$categories['category_name']}}</a></li>
							@endif
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
							@if($categories)
							<div class="single_blog">
								<div class="single_blog_img">
									<a href="#"><img src=" {{url('storage/category/'.$categories['category_image'])}}" alt=""></a>
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
							@else
								No category found!!
							@endif
						<!-- End Single blog -->			

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
				data:{'str':str,'id':cid},
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