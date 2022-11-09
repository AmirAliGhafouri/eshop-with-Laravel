<?php

use App\Http\Controllers\productController;
use App\Models\user;
use Illuminate\Support\Facades\Session;
  $logged=false;
  $admin=false;

  $cart_count=productController::cart_count();
  if(Session::has('user')){
    $logged=true;
    if(Session::get('user')['admin'])
      $admin=true;
  }
    
?>
<nav class="navbar navbar-expand-md  navbar-dark bg-dark p-4">
    <a class="navbar-brand" href="/">
      <img src="{{ URL::asset('images/eshop_logo.png')}}" alt="site-logo" class="site-logo">
    </a>

  <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    
    <div class="main-search mx-3">
      <!-- <form class="form-inline my-2 my-lg-0 "> -->
        <input class="form-control mr-sm-2 shp-search" type="search" placeholder="جستجو . . ." aria-label="Search" id="search_input">
        <!-- <button class="btn search-btn my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button> -->
      <!-- </form> -->
      <div id="content" class="search-resault-container"></div>
    </div>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mr-4">
      @if($logged && !$admin)
      <li class="nav-item ml-2">
        <a class="nav-link drop-link " href="cart-list" style="white-space: nowrap;"><i class="fa-solid fa-cart-shopping"></i> سبد خرید({{$cart_count}})</a>
      </li>
      @endif
     
      <li class="nav-item dropdown ml-2">
        <a class="nav-link dropdown-toggle drop-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(!$logged)
            حساب کاربری <i class="fa fa-user"></i>
          @else
            {{user::where('id' , Session::get('user')['id'])->first()->name}} <i class="fa fa-user"></i>
          @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          @if(!$logged && !$admin)
              <a class="dropdown-item" href="/login">ورود </a>
              <a class="dropdown-item" href="/sign-in">ثبت‌‌نام</a>
          @elseif($logged && !$admin)
              <a class="dropdown-item" href="/logout">خروج </a>
              <a class="dropdown-item" href="/user-panel">پنل کاربری</a>
          @elseif($admin)
              <a class="dropdown-item" href="/logout">خروج </a>
              <a class="dropdown-item" href="/admin-panel"> پنل ادمین</a>
              <a class="dropdown-item" href="/add-admin">افزودن ادمین</a>
          @endif
        </div>
      </li>
    </ul>    
  </div>
  
</nav>

<script type="text/javascript">
    $('#search_input').on("keyup",function(){
        //alert('hi');
        $value=$(this).val();
        //alert($value);
        $.ajax({
            type:'get',
            url:"{{URL::to('search')}}",
            data:{'search':$value},
            success: function(data){
                $('#content').html(data);                   
            }
        });

    });
</script>