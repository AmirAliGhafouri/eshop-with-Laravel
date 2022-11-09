<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
//________________ admin panel view
    function admin_panel(){
        $users=user::all();
        return view('admin_panel' , ['users'=>$users]);
    }

//________________ Add new product
    function add_product(Request $req){
        $req->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'image'=>'required|image'
        ]);
       //save image
       $file=$req->file('image');
       $filename=$file->getClientOriginalName();
       $dstPath=public_path()."/images/products";
       $file->move($dstPath,$filename);

       //save to DataBase
       $newProduct= new product;
       $newProduct->name=$req->name;
       $newProduct->price=$req->price;
       $newProduct->category=$req->category;
       $newProduct->description=$req->description;
       $newProduct->gallery=$filename;
       $newProduct->quantity_sold=0;
       $newProduct->save();

       return back()->withInput();
    }

//________________ Remove product
    function remove_product($id){
        product::destroy($id);
        return redirect('/');
    }

//________________ edit product view
    function edit_product($id){
        try{
            $product=product::findOrFail($id);
        }
        catch(\Exception $exception){
            return view('error');
        }
        return view('edit_product' , ['product'=>$product]);
    }

//________________ edit product
    function edit(Request $req , $id){
        if($req->name)
            product::where('id',$id)->update(['name'=>$req->name]);
        if($req->price)
            product::where('id',$id)->update(['price'=>$req->price]);
        if($req->category!="not_selected")
            product::where('id',$id)->update(['category'=>$req->category]);
        if($req->description)
            product::where('id',$id)->update(['description'=>$req->description]);
        if($req->file('image')){
            $file=$req->file('image');
            $filename=$file->getClientOriginalName();
            $dstPath=public_path()."/images/products";
            $file->move($dstPath,$filename);
            product::where('id',$id)->update(['gallery'=>$filename]);
        }

        return back()->withInput();
    }

//________________ admin register view
    function admin_register(){
        return view('admin_register');
    }

//________________ add new admin
    function admin_signin(Request $req){
        $admin=new user;
        $admin->name=$req->name;
        $admin->email=$req->email;
        $admin->password=Hash::make($req->pswd);
        $admin->admin=1;
        $admin->save();
        return redirect('/');
    }

}
