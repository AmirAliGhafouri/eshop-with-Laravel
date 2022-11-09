<?php

use App\Http\Controllers\productController;
use App\Models\order;

?>
@extends('master')
@section('content')


<div class="container">
   <div class="d-flex justify-content-around flex-wrap">
        <div class="col-md-5 my-5">
            <h2 class="text-center display-5 mb-5">مشخصات</h2>
            <table class="table text-center">
                <tr>
                    <th>نام کاربری</th>
                    <td>{{$info->name}}</td>
                </tr>
                    
                <tr>
                    <th>ایمیل</th>
                    <td>{{$info->email}}</td>
                    <!-- <td><a href="/user-edit"><button class="shop-btn m-0 p-2 rounded">ویرایش‌مشخصات</button></a></td> -->
                </tr>               
            </table>
        </div>
        <div class="col-md-5 my-5">
            <h2 class="text-center display-5 mb-5">ویرایش</h2>
            <div>
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="نام جدید . . .">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email" placeholder="ایمیل جدید . . .">
                        @error('email')
                            <div id="validationServer03Feedback" class="invalid-feedback text-right">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                   <!--  <div class="form-group">
                        <input type="password" class="form-control @error('pswd') {{'is-invalid'}} @enderror" id="pwd" name="pswd" placeholder="رمز جدید . . .">
                        @error('pswd')
                            <div id="validationServer03Feedback" class="invalid-feedback text-right">
                                {{$message}}
                            </div>
                        @enderror
                    </div>    -->

                    <div class="text-center">
                        <button type="submit" class="btn second-btn">ثبت‌تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
   </div>

    <div class="text-center my-3">
        <img class="img-fluid img-responsive rounded product-image order-img"  src='{{URL::asset("images/orders.png")}}'>
    </div>
    @if($orders->all())
    <h2 class="display-4 my-5 text-center">تاریخچه ی سفارش ها</h2>
    @foreach($orders->all() as $item)
        <a href="order-list/{{$item->date}}">
            <ul class="d-flex justify-content-between p-2 my-4 border rounded">
                <div class="d-flex">
                    @foreach(productController::order_group_list($item->date)->all() as $product)
                        <li class="m-1"><img src='{{URL::asset("images/products/$product->gallery")}}' class="img-fluid img-responsive rounded order-img"></li>
                    @endforeach
                </div>
                <div class="d-flex align-items-center">
                    <li class="text-left order-date">{{$item->date}}</li>
                </div>
            </ul>
        </a>
    @endforeach
    @else
        <div class="container text-center my-5">
            <h2 class="display-4">سفارشی موجود نیست</h2>
        </div>
    @endif
</div>



@endsection
