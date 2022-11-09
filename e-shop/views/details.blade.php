<?php

use App\Http\Controllers\productController;
use App\Models\rate;
use Illuminate\Support\Facades\Session;
$allow_rate="";
$user_rate="";
if(Session::has('user')){
	$allow_rate=true;
	$user_id=Session::get('user')['id'];
	if(rate::where(['user_id'=>$user_id , 'product_id'=>$product->id])->first()){
		$allow_rate=false;
		$user_rate=rate::where(['user_id'=>$user_id , 'product_id'=>$product->id])->first()->rating;
	}
}
?>
@extends('master')
@section('content')

<div class="container">
    <div class="row my-5 d-flex flex-row-reverse">
		<div class="col-lg-6 mb-5">
    		<img src='{{URL::asset("images/products/$product->gallery")}}' class="img-fluid rounded ">
			@if($allow_rate===true)
				<div class="text-right">
					<label for="product_rating">ثبت امتیاز : </label><span id="rate"></span>
					<input type="range" class="form-control-range" min="0" max="5" id="product_rating" style="direction: ltr;">
				</div>
			@endif
			@if($allow_rate===false)
				<div class="text-center my-5">
					امتیاز شما : 
					@for($i=0;$i < $user_rate;$i++)
                        <i class="fa fa-star str-rate"></i>
                    @endfor
				</div>
			@endif
			
    	</div>
        <div class="col-lg-6 product-details pl-md-5 text-justify">
    		<h2 class="display-4 mb-3"><strong>{{$product->name}}</strong></h2>			
    		<h3 class="mb-5">{{$product->price}}ريال</h3>
			<p>{{$product->description}}</p>
          	<div class="text-center mt-2">
				@if(Session::has('user'))
					@if(Session::get('user')['admin'])
						<a href="/edit-product/{{$product->id}}" class="btn second-btn mr-2">ویرایش <i class="fa-solid fa-pen-to-square"></i></a>
						<a href="/remove-product/{{$product->id}}" class="btn second-btn btn-alert mr-2 ">حذف <i class="fas fa-trash-alt"></i></a>
					@else
						<a href="/addtocart/{{$product->id}}" class="btn shop-btn">افزودن‌به‌سبد‌خرید <i class="fa-solid fa-cart-plus"></i></a>
					@endif
				@endif
			</div>			
    	</div>    	 			
    </div>
	<div>
		<h2 class="text-center display-5"><strong>نظرات :</strong></h2>
		@if($comments->all())
			
				<div class="row d-flex justify-content-center my-4">
					<div class="col-md-8 col-lg-8">
						<div class="card shadow-0 border comments-body">
							<div class="card-body p-4">
							@foreach($comments as $cmt)
								<div class="card my-3">
									<div class="p-3">
										<div class="d-flex justify-content-between">
											<div class="d-flex flex-row align-items-center justify-content-center user-comment">
												<p class="small mb-0 ms-2"><strong>{{$cmt->name}}</strong></p>
											</div>											
										</div>
										<p class="text-right mr-4 mt-3">{{$cmt->comment}}</p>	
										@if(Session::has('user'))
											@if(productController::user_comment_rate($cmt->id))
												<div>
													نظر کاربران :
													<span>{{productController::rating_cmt($cmt->id)}}</span>
												</div>
												@if(productController::user_comment_rate($cmt->id)->rating=="like")
													<div>
														باز خورد شما :
														<i class="fa-solid fa-thumbs-up"></i>
													</div>
												@endif
												@if(productController::user_comment_rate($cmt->id)->rating=="dislike")
													<div>
														باز خورد شما :
														<i class="fa-solid fa-thumbs-down"></i>
													</div>
												@endif
											@else
											<div>
												<span class="like-comment"><i class="fa-solid fa-thumbs-up comment-rate"></i></span>
												<span class="cmt_rating">{{productController::rating_cmt($cmt->id)}}</span>
												<span class="dislike-comment"><i class="fa-solid fa-thumbs-down comment-rate"></i></span>
												<input type="hidden" value="{{$cmt->id}}" class="cid">
											</div>	
											@endif	
										@endif			
									</div>
								</div>
							@endforeach
							</div>
						</div>
					</div>
				</div>
			
		@else
			<div class="text-center my-5"> نظری ثبت نشده است </div>
		@endif

		@if($allow_comment===true)
			<div class="my-5">
				<form action="#" method="POST">
					@csrf
					<div class="d-flex justify-content-center">
						<textarea name="comment" class="comment-box" placeholder="لطفا نظر خود را وارد کنید . . ."></textarea>
					</div>
					<div class="d-flex justify-content-center">
						<button type="submit" class="btn shop-btn px-4 my-3">ثبت نظر</button>
					</div>
				</form>
			</div>
		@endif
	</div>	
</div>

<script type="text/javascript">
    $('.like-comment').on("click",function(){
        
        $value="like";
		$cid=$(this).siblings(".cid").val();
		$txt=$(this).siblings(".cmt_rating").text();
		$resault=$(this).siblings(".cmt_rating");
		$like=$(this);
		$dislike=$(this).siblings(".dislike-comment");
        $.ajax({
            type:'get',
            url:"{{URL::to('comment-rate')}}",
            data:{'rating':$value , 'cid':$cid , 'txt':$txt},
            success: function(data){
				console.log(data);
                $resault.html(data);
				$like.css("color" , "lime");
				$dislike.remove();
            }
        });

    });

	$('.dislike-comment').on("click",function(){

        $value="dislike";
		$cid=$(this).siblings(".cid").val();
		$txt=$(this).siblings(".cmt_rating").text();
		$resault=$(this).siblings(".cmt_rating");
		$dislike=$(this);
		$like=$(this).siblings(".like-comment");
        $.ajax({
            type:'get',
            url:'{{URL::to("comment-rate")}}',
            data:{'rating':$value , 'cid':$cid , 'txt':$txt},
            success: function(data){
				console.log(data);
				$resault.html(data);
				$dislike.css("color" , "red");
				$like.remove();
            }
        });

    });

	$('#product_rating').on("change",function(){
        //alert('hi');
        $value=$(this).val();
		$pid="{{$product->id}}";
        //alert($value);
        $.ajax({
            type:'get',
            url:"{{URL::to('rate')}}",
            data:{'rating':$value , 'pid':$pid},
            success: function(data){
                    $('#rate').html(data);
                   	$('#product_rating').prop( "disabled", true );
            }
        });

    });
</script>

@endsection