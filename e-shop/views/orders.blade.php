@extends('master')
@section('content')
    <div class="container my-5">
        <div class="row mt-5 pt-3 d-flex flex-row-reverse">
            <div class="col-md-6">
                    <div class=" p-3 p-md-4">
                        <h3 class="text-center mb-4">جزئیات پرداخت</h3>
                        <p class="d-flex justify-content-around my-5">
                            <span>جمع هزینه ها</span>
                            <span>{{$total}}ريال</span>
                        </p>
                        
                        <p class="d-flex justify-content-around my-5">
                            <span>هزینه ارسال</span>
                            <span>150000ريال</span>
                        </p>
                        <hr>
                        <p class="d-flex justify-content-around">
                            <span>جمع کل پراختی</span>
                            <span>{{$total+150000}}ريال</span>
                        </p>
                    </div>
                </div>
	          	<div class="col-md-6">
	          		<div class="cart-total p-3 p-md-4">
	          			<h3 class="text-center mb-4">آدرس و شیوه ی پرداخت</h3>
                        <form action="/order-place" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control addr-box" name="address" rows="3" placeholder="آدرس خود را وارد کنید . . ."></textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio text-right">
                                        <label><input type="radio" name="payment" class="mr-2" value="Online-Payment" checked>پرداخت آنلاین</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio text-right">
                                        <label><input type="radio" name="payment" class="mr-2" value="Payment on delivery">پرداخت هنگام تحویل کالا</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn shop-btn px-5" type="submit">پرداخت</button>
                            </div>
                        </form>
					</div>
	          	</div>
            </div> 
    </div>
@endsection
