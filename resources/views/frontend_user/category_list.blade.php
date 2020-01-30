@include('frontend_user.header')
		
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>All Categories</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
							<li><span>category</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<div class="single_sidebar search_widget">
						<h3 class="sdbr_title">Search</h3>
						<div class="sdbr_inner">
							<form class="search_form" >
								<input type="text" class="form-control search_input" name="search" id="search" placeholder="Search  Categories ...">
								<button type="button" class="search_button"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Blog Page -->
		<div id="blog_page_area">
			<div class="container">
				<div class="row">				
					<div class="col-md-12 col-xs-12">
						<div class="row category_container" >
							<!-- <div class="searchedCategories"> -->
							@foreach ($category as $cat)
								<!-- Single blog -->
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="single_blog" >
										<div class="single_blog_img">
											<a href="{{route('frontend.subcategory.list',['id'=>$cat->id])}}"><img src="{{url('frontend/img/blog/1.jpg')}}" alt=""></a>
										</div>						
										<div class="blog_content">
											<ul class="post-meta">
												<li><i class="ti-eye"></i> <a href="#">{{$sub[$cat->id]}} Subcategories</a></li>

											</ul>
											<h4 class="post_title"><a href="{{route('frontend.subcategory.list',['id'=>$cat->id])}}">{{ $cat->category_name}}</a> </h4>															
											<p>
												{{$cat->category_desc}}
											
											</p>
										</div>
									</div>
								</div>
							@endforeach	
							<!-- </div> -->
						</div>
						
						<div class="blog_pagination pgntn_mrgntp fix text-center">
							<div class="pagination text-center">
								<!-- <ul>
									<li><a href="#"><i class="fa fa-angle-left"></i></a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#" class="active">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
								</ul> -->
								 {!! $category->links() !!}
							</div>
						</div>					
					</div>
								
				</div>							
			</div>
		</div>

@include('frontend_user.footer')
<script>
	$(document).ready(function(){
		// console.log($('.category_container').html());
		var previdata=$('.category_container').html();
		// console.log(previdata);
		$('#search').keyup(function(){
			if($('#search').val()=='')
			{
				$('.category_container').html(previdata);
			}
			var str=$(this).val();
			var divi='';	
			var subarray;		
			// alert(subarray);
			$.ajax({
				url:"{{route('frontend.category.list.ajax')}}",
				method:'get',
				dataType:'json',
				data:{'str':str},
				success: function(response)
				{
					if(response['success']){
						category=response['data'];
						innerdiv='';
						
						subarray=response['sub'];
						$.each(category,function(key,value){
							var id=category[key].id;
							var route="{{route('frontend.subcategory.list',['id' => 0])}}";
							var splitarr=route.split('/');
							splitarr[splitarr.length-1]=id;
							route1=splitarr[splitarr.length-2]+'/'+splitarr[splitarr.length-1];
							var imgRoute = "{{url('frontend/img/blog/1.jpg')}}";
							
							innerdiv+='<div class="col-lg-4 col-md-6 col-sm-6"><div class="single_blog"><div class="single_blog_img"><a href="'+route1+'"><img src="'+imgRoute+'" alt=""></a></div><div class="blog_content"><ul class="post-meta"><li><i class="ti-eye"></i><a href="#"> '+subarray[value.id]+' Subcategories</a></li></ul><h4 class="post_title"><a href="'+route1+'">'+ value.category_name+'</a></h4><p>'+value.category_desc+'</p></div></div></div><br>';
							console.log(innerdiv);
						});
						$('.category_container').html(innerdiv);
					}
					else
					{
						$('.category_container').html("Sorry no category found!!!");	
					}					
				}
				

			});
		});
	});
</script>