@extends('master')
@section('content')


<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <img src='{{URL::asset("images/cartList.png")}}' class="img-fluid img-responsive cart-img">
    </div>
@if($products->all())
    @foreach($products as $product)
    <div class="d-flex justify-content-center row my-2">
        <div class="col-md-10">
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-4 mt-1">
                    <a href="/details/{{$product->id}}">
                        <img class="img-fluid img-responsive rounded product-image"  src='{{URL::asset("images/products/$product->gallery")}}'>
                    </a>
                </div>
                <div class="col-md-5 mt-1 d-flex align-items-center justify-content-center">
                    <h2 class="form-center">{{$product->name}}</h2>
                </div>
                <div class="col-md-3 mt-1 d-flex justify-content-center align-items-center flex-column">
                    <div>
                        <h4 class="mr-1">{{$product->price}}ريال</h4>
                    </div>
                    <div class=" mt-4 ">                      
                        <a class="btn btn-alert" href="/remove-cart/{{$product->cart_id}}">حذف‌از‌سبد‌خرید <i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center my-5">
        <a href="/order-place" class="btn shop-btn pb-1 px-5">سفارش</a>
    </div>
@else
    <div class="d-flex justify-content-center">
        <p class="display-2 mb-5 alert alert-danger">سبد خرید شما خالی است !</p>
    </div>
@endif
</div>


@endsection
