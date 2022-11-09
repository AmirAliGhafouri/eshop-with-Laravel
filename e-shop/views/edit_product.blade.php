@extends('master')
@section('content')

<div class="container my-5">
    <h2 class="text-center display-4 my-5">ویرایش <i class="fa-solid fa-pen-to-square"></i></h2>
    <div class="row mt-5 pt-3 d-flex">
	    <div class="col-md-6 d-flex justify-content-center">
                <div class="card" style="width:400px;border:none;">
                    <img class="card-img-top" src='{{URL::asset("images/products/$product->gallery")}}' alt="Card image" style="width:100%">
                    <div class="card-body text-right">
                        <h2 class="card-title"><strong>نام : </strong>{{$product->name}}</h2>
                        <p class="card-text"><strong>قیمت : </strong>{{$product->price}}ريال</p>
                        <p class="card-text"><strong>دسته‌بندی : </strong>{{$product->category}}</p>
                        <p class="card-text text-justify"><strong>توضیحات : </strong>{{$product->description}}</p>
                    </div>
                </div>
	    </div>
        <div class="col-md-6">
            <h2 class="text-center">تغییرات</h2>
            <form action="/edit/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group text-right">
                    <label for="pname">نام محصول :</label>
                    <input type="text" class="form-control" id="pname" placeholder=" نام جدید . . ." name="name">
                </div>

                <div class="form-group text-right">
                    <label for="price">قیمت :</label>
                    <input type="text" class="form-control" id="price" placeholder=" قیمت جدید  . . ." name="price">
                </div>

                <div class="form-group text-right">
                    <label>دسته‌بندی :</label>
                    <select class="form-control" name="category">
                        <option value="not_selected">انتخاب نشده</option>
                        <option value="laptop">لپتاپ</option>
                        <option value="mobile">موبایل</option>
                        <option value="perfume">عطر و ادکلن</option>
                        <option value="shoe">کفش و کتانی</option>
                        <option value="watch">ساعت مچی</option>
                    </select>
                </div>

                <div class="form-group text-right">
                    <label for="description">توضیحات :</label>
                    <div class="form-group">
                        <textarea class="form-control addr-box" id="description" name="description" rows="2" placeholder=" توضیحات جدید . . ."></textarea>
                    </div>
                </div>

                <div class="form-group text-right">
                    <label for="image">تصویر جدید :</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn second-btn">ذخیره تغییرات</button>
                </div>
            </form>     
        </div>
    </div> 
</div>

@endsection
