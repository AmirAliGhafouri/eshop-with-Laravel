@extends('master')
@section('content')

<div class="form-back-ground">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex my-5">
                    <div class="col-lg-6 ftco-animate d-flex justify-content-center align-items-center " style="background-color:#1b1e21 ;">
                        <img class="img-fluid img-responsive rounded product-image"  src='{{URL::asset("images/Registratioin.png")}}' width="200px">
                    </div>
                    <div class="col-lg-6 pl-md-5 ftco-animate">                
                        <h2 class="display-5 form-center my-5">افزودن ادمین</h2>
                        <form action="#" method="POST" style="text-align:right ;">
                            @csrf
                            <div class="form-group">
                                <label for="name">نام :</label>
                                <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name">
                                @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="email">ایمیل :</label>
                                <input type="email" class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email">
                                @error('email')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pwd">رمز عبور :</label>
                                <input type="password" class="form-control @error('pswd') {{'is-invalid'}} @enderror" id="pwd" name="pswd" >
                                @error('pswd')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>                          
                            <div class="form-center my-5">
                                <button type="submit" class="btn shop-btn login-btn">افزودن ادمین</button>
                            </div>
                        </form>
                    </div>		
                </div>
            </div>
        </div>
    </div>
</div>
@endsection