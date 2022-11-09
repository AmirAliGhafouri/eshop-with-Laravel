<?php
    $counter=1;
?>
@extends('master')
@section('content')

<div class="container">
<!-- Usernames -->
    <h2 class="text-center display-4">کاربران</h2>
    <div class="my-5 users-container col-6 m-auto">
        @foreach($users as $user)
            <a href="/user-info/{{$user->id}}">
                <div class="my-2 text-right border p-3 rounded ad-users">
                    {{$counter}} . {{$user->name}}
                </div>
            </a>
            @php
                $counter++;
            @endphp
        @endforeach
    </div>

<!-- ADD products -->
    <div class="text-right col-8 m-auto">
        <h2 class="display-4 text-center my-5">افزودن محصول</h2>
        <form action="/add-product" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pname">نام محصول :</label>
                <input type="text" class="form-control  @error('name') {{'is-invalid'}} @enderror" id="pname" name="name">
                @error('name')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">قیمت :</label>
                <input type="text" class="form-control @error('price') {{'is-invalid'}} @enderror" id="price" name="price">
                @error('price')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label>دسته بندی :</label>
                <select class="form-control" name="category">
                    <option value="laptop">لپتاپ</option>
                    <option value="mobile">موبایل</option>
                    <option value="perfume">عطر و ادکلن</option>
                    <option value="shoe">کفش</option>
                    <option value="watch">ساعت مچی</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">توضیحات :</label>
                <div class="form-group">
                    <textarea class="form-control addr-box @error('description') {{'is-invalid'}} @enderror" id="description" name="description" rows="2"></textarea>
                    @error('description')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image">عکس محصول :</label>
                <input type="file" class="form-control @error('image') {{'is-invalid'}} @enderror" id="image" name="image">
                @error('image')
                <div>
                    <p style="color:red;">فایل آپلود شده فقط می تواند یک تصویر باشد</p>
                </div>
                @enderror
            </div>

            <div class="text-center mb-5">
                <button type="submit" class="btn second-btn px-5">افزودن</button>
            </div>
        </form>
    </div>
</div>

@endsection