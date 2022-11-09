@extends('master')
@section('content')
@isset($login_error)
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{$login_error}}  
    </div>
@endisset
@isset($account)
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{$account}}  
    </div>
@endisset

<div class="form-back-ground">
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex my-5">
                        <div class="col-lg-6 ftco-animate d-flex justify-content-center align-items-center " style="background-color:#1b1e21 ;">
                            <img class="img-fluid img-responsive rounded product-image"  src='{{URL::asset("images/login3.png")}}' width="200px">
                        </div>
                        <div class="col-lg-6 pl-md-5 ftco-animate">                
                                <h2 class="display-5 form-center my-5">ورود به حساب کاربری</h2>
                                <form action="/login" method="POST" style="text-align:right ;">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">ایمیل :</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">رمز عبور :</label>
                                        <input type="password" class="form-control" id="pwd" name="pswd">
                                    </div>
                                    <div class="form-center">
                                        <button type="submit" class="btn shop-btn login-btn">ورود</button>
                                    </div>
                                </form>
                                <p class="form-txt my-5">قبلا ثبت نام نکردید؟<a href="/sign-in"><b>ایجاد حساب</b></a></p>                   
                        </div>		
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
