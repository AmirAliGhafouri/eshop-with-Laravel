@extends('master')
@section('content')
<div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
  </ul>
  <div class="carousel-inner">
    @php
      $counter=0;
    @endphp
    @foreach($products as $item)
        <div class="carousel-item @if($counter==0){{'active'}} @endif">    
        <a href="/details/{{$item->id}}">
          <img src="images/products/{{$item->gallery}}" alt="Los Angeles" class="carousel-img">
          <div class="carousel-caption">
            <h3>{{$item->name}}</h3>
          </div> 
          </a>  
        </div>
        
        @php
          $counter++;
        @endphp

        @if($counter>=4)
          @break
        @endif  
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="next">
    <!-- <span class="carousel-control-prev-icon"></span> -->
    <i class="fas fa-chevron-circle-left crousel-arrow"></i>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="prev">
    <!-- <span class="carousel-control-next-icon"></span> -->
    <i class="fas fa-chevron-circle-right crousel-arrow"></i>
  </a>
</div>

<h2 class="Display-2 form-center my-5">دسته‌بندی‌ها</h2>
<div class="container">

  <div class=" d-flex justify-content-center flex-wrap mb-3">
    
    <div class=" d-flex justify-content-center flex-column card-size" width="150"> 
        <div class="d-flex justify-content-center">
            <a href="/products/mobile" class="card-link" style="border-radius: 50%;">
              <div class="card-img-container d-flex justify-content-center align-items-center">
                <img class="card-img-top category-img" src="{{URL::asset('images/category/phone-logo.png')}}" alt="Card image">
              </div>
            </a>
        </div>
        <div class="card-body">
            <h4 class="card-title"> موبایل و لوازم جانبی</h4>
        </div>
    </div>

    <div class=" d-flex justify-content-center flex-column card-size" width="150"> 
        <div class="d-flex justify-content-center">
            <a href="/products/laptop" class="card-link" style="border-radius: 50%;">
              <div class="card-img-container d-flex justify-content-center align-items-center">
                <img class="card-img-top category-img" src="{{URL::asset('images/category/laptop-logo.png')}}" alt="Card image">
              </div>
            </a>
        </div>
        <div class="card-body">
          <h4 class="card-title text-center">کامپیوتر و لپتاپ</h4>
        </div>
    </div>

    <div class=" d-flex justify-content-center flex-column card-size" width="150"> 
        <div class="d-flex justify-content-center">
            <a href="/products/perfume" class="card-link" style="border-radius: 50%;">
              <div class="card-img-container d-flex justify-content-center align-items-center">
                <img class="card-img-top category-img" src="{{URL::asset('images/category/perfume_logo.png')}}" alt="Card image">
              </div>
            </a>
        </div>
        <div class="card-body">
          <h4 class="card-title text-center">عطر و ادکلن</h4>
        </div>
    </div>

    <div class=" d-flex justify-content-center flex-column card-size" width="150"> 
        <div class="d-flex justify-content-center">
            <a href="/products/shoe" class="card-link" style="border-radius: 50%;">
              <div class="card-img-container d-flex justify-content-center align-items-center">
                <img class="card-img-top category-img" src="{{URL::asset('images/category/shoe-logo.png')}}" alt="Card image">
              </div>
            </a>
        </div>
        <div class="card-body">
          <h4 class="card-title text-center">کفش و کتانی</h4>
        </div>
    </div>

    <div class=" d-flex justify-content-center flex-column card-size" width="150"> 
        <div class="d-flex justify-content-center">
            <a href="/products/watch" class="card-link" style="border-radius: 50%;">
              <div class="card-img-container d-flex justify-content-center align-items-center">
                <img class="card-img-top category-img" src="{{URL::asset('images/category/watch_logo.png')}}" alt="Card image">
              </div>
            </a>
        </div>
        <div class="card-body">
          <h4 class="card-title text-center">ساعت مچی</h4>
        </div>
    </div> 
  </div>

</div>

@endsection