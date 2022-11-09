<?php

use App\Http\Controllers\productController;
use App\Models\order;

?>
@extends('master')
@section('content')
<div class="container">
    <h2 class="display-4 my-5 text-center">سفارش ها</h2>
    <table class="table text-center">
        <tr>
            <th>تصویر محصول</th>
            <th>نام محصول</th>
            <th>قیمت</th>
            <th>نوع پرداخت</th>
            <th>محل ریافت</th>
        </tr>
        
        @foreach($orders->all() as $product)
            <tr>
                <td><img src='{{URL::asset("images/products/$product->gallery")}}' class="img-fluid img-responsive rounded order-img"></td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->payment_method}}</td>
                <td>{{$product->address}}</td>
            </tr>
        @endforeach    
        
    </table>
    

</div>


@endsection
