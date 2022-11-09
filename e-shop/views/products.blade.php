<?php

use App\Http\Controllers\productController;

?>
@extends('master')
@section('content')

<div class="container d-flex justify-content-center flex-wrap my-5">
    @foreach($products as $item)
        <a href="/details/{{$item->id}}" class="card-txt">
            <div class="card card-products">
                <img class="card-img-top" src='{{URL::asset("images/products/$item->gallery")}}' alt="Card image" style="width:100%">
                <div class="card-body text-center">
                    <h4 class="card-title">{{$item->name}}</h4>
                    <!-- <p class="card-text">{{$item->description}}</p> -->
                    
                    <div class="my-4">
                        @if(productController::rating_avg($item->id)!="امتیازی ثبت نشده است")
                            @for($i=0;$i < round(productController::rating_avg($item->id));$i++)
                                <i class="fa fa-star str-rate"></i>
                            @endfor
                        @else
                            {{productController::rating_avg($item->id)}}
                        @endif
                    </div>
                    <p class="card-text badge">{{$item->price}}ريال</p>
                </div>
            </div>
        </a>
    @endforeach
</div>


@endsection
        