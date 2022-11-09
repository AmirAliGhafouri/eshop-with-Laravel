<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\comment;
use App\Models\comments_rate;
use App\Models\order;
use App\Models\product;
use App\Models\rate;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class productController extends Controller
{
    private $allow_comment=false;

    //__________ main page view
    public function index(){
        $products=product::all();
        //________amount of order
        foreach($products as $order){
            $count= order::where('product_id' , $order->id)->count();
            product::where('id' , $order->id)->update(['quantity_sold'=>$count]);
        }
        $trend_product=collect($products)->sortBy('quantity_sold')->reverse();
        return view('index',['products'=>$trend_product]);
    }

    //__________ show products page
    function products($category){
        $products=product::where('category' , $category)->get();
        return view('products',['products'=>$products]);
    }

    //__________ product details page
    function details($id){
        try{
            $detail=product::findOrFail($id);
        }
        catch(\Exception $exception){
            return view('error');
        }
        

        $comments=DB::table('comments')
        ->join('users','comments.user_id' , '=' , 'users.id')
        ->where('comments.product_id' , $id)
        ->select('comments.comment' , 'comments.id' ,'users.name')
        ->get();           
        if(Session::has('user')){
            $user_id=Session::get('user')['id'];       
           
            if(order::where(['user_id'=>$user_id , 'product_id'=>$id])->first()){
                $this->allow_comment=true;
            }
                
        }
            
        return view('details',['product'=>$detail , 'comments'=>$comments , 'allow_comment'=>$this->allow_comment]);
    }

    //__________ Add product into cartList
    function add_to_cart($id){
        $user_id=Session::get('user')['id'];
        cart::create([
            'user_id'=>$user_id,
            'product_id'=>$id
        ]);
        return redirect('/');
    }

    //__________ cart List view
    function cart_list(){
        $user_id=Session::get('user')['id'];
        $products=DB::table('carts')
        ->join('products','carts.product_id' , '=' , 'products.id')
        ->where('carts.user_id' , $user_id)
        ->select('products.*','carts.id as cart_id')
        ->get();

        return view('cart_list',['products'=>$products]);
    }

    //__________ count of products in cartList
    static function cart_count(){
        if(Session::has('user')){
            $user_id=Session::get('user')['id'];
            return cart::where('user_id' , $user_id)->count();
        }
    }

    //__________ remove product from cartlist
    function remove_cart($id){
        cart::destroy($id);
        return redirect('cart-list');
    }

    //__________ order page & total price 
    function order_place(){
        $user_id=Session::get('user')['id'];
        $total=DB::table('carts')
        ->join('products' , 'carts.product_id' , '=' , 'products.id')
        ->where('carts.user_id',$user_id)
        ->sum('products.price');
        return view('orders',['total'=>$total]);
    }

    //__________ finishing ordering steps & empty the artList & move products in order table
    function order_now(Request $req){
        //check address
        if(!isset($req->address))
            return back()->withInput();
    
        $user_id=Session::get('user')['id'];
        $allcart=cart::where('user_id',$user_id)->get();

        //move informations into order table
        foreach($allcart as $cart){
            $date=date("Y-m-d,h:i:s");
            $order=new order;
            $order->user_id=$cart['user_id'];
            $order->product_id=$cart['product_id'];
            $order->status="pending";
            $order->payment_method=$req->payment;
            $order->payment_status="pending";
            $order->address=$req->address;
            $order->date=$date;
            $order->save();
        }
        //empty the cartlist
        cart::where('user_id',$user_id)->delete();
        return redirect('/');
    }

    //__________ Orders-group History1
    function user_panel(){
        $user_id=Session::get('user')['id'];
        //oreders history
        $orders= DB::table('orders')
        ->where('user_id' , $user_id)
        ->select('date', DB::raw('count("date") as occurences'))
        ->groupBy('date')
        ->having('occurences', '>', 0)
        ->get();

        //user info
        $user_info=user::where('id' , $user_id)->first();
        return view('user_panel' , ['orders'=>$orders , 'info'=>$user_info]);
    }

    //__________ Orders-group History2
    static function order_group_list($order){
        $user_id=Session::get('user')['id'];
        $joined_order=DB::table('orders')
        ->join('products' , 'orders.product_id' , '=' , 'products.id')
        ->where(['orders.user_id'=>$user_id , 'orders.date'=>$order])
        ->select('name','gallery' , 'address' , 'payment_status' , 'orders.date')
        ->get();
        return $joined_order;
    }

    //__________ show ordered products
    function order_list($group){
        $user_id=Session::get('user')['id'];
        $joined_order=DB::table('orders')
        ->join('products' , 'orders.product_id' , '=' , 'products.id')
        ->where(['orders.user_id'=>$user_id , 'orders.date'=>$group])
        ->select('name','gallery' , 'address' , 'payment_method' , 'orders.date' , 'price')
        ->get();

        return view('order_list' , ['orders'=>$joined_order]);
    }


    //__________ Live_Search
    function search(Request $req){
        $output="";
        $query_result=product::where('name','Like','%'.$req->search.'%')->get();
        if($req->search){
            foreach($query_result as $product){
                $img="../images/products/$product->gallery";
                $output.='<a href="/details/'.$product->id.'" class="search-link"><div class="mb-1 border-bottom search-resault d-flex align-items-center p-1">
                <img src="'.$img.'" class="img-fluid rounded search-img ml-1"><p class="text-center" style="width:100%;">'
                    .$product->name.
                '</p></div></a>';
            }
            return response($output);
        }
    }

    //__________ Rate
    function rate(Request $req){
        $user_id=Session::get('user')['id'];
        $rate=rate::where(['user_id'=>$user_id , 'product_id'=>$req->pid])->first();
        if(!$rate){
            $rate_product=new rate;
            $rate_product->user_id=$user_id;
            $rate_product->product_id=$req->pid;
            $rate_product->rating=$req->rating;
            $rate_product->save();
            
            return $req->rating;
        }
    }

    //__________ Rating average
    static function rating_avg($id){
        $p_rate=rate::where('product_id',$id);
        if(!$p_rate->first())
            return "امتیازی ثبت نشده است";
        else{
            return $p_rate->avg("rating");
        } 
    }

    //__________ Add comment
    function add_comment(Request $req , $id){
        $user_id=Session::get('user')['id'];
        $comment= new comment;
        $comment->user_id=$user_id;
        $comment->product_id=$id;
        $comment->comment=$req->comment;
        $comment->save();

        return redirect("details/$id");
    }

    //__________ comments Rate
    function comment_rate(Request $req){
        $user_id=Session::get('user')['id'];
        $rate=comments_rate::where(['user_id'=>$user_id , 'comment_id'=>$req->cid])->first();
        if($rate)
            return $req->txt;
        if($req->rating=="like"){
            if(!$rate){
                $newrate= new comments_rate;
                $newrate->user_id=$user_id;
                $newrate->comment_id=$req->cid;
                $newrate->rating="like";
                $newrate->save();

                $new=$req->txt + 1;
                return $new;
            }
          
        }

        if($req->rating=="dislike"){
            if(!$rate){
                $newrate= new comments_rate;
                $newrate->user_id=$user_id;
                $newrate->comment_id=$req->cid;
                $newrate->rating="dislike";
                $newrate->save();

                $new=$req->txt - 1;
                return $new;
            }
           
        }
        
    }

    //__________ calculating comments Rating
    static function rating_cmt($id){
        $like=comments_rate::where(['comment_id'=>$id , 'rating'=>"like" ])->count();
        $dislike=comments_rate::where(['comment_id'=>$id , 'rating'=>"dislike" ])->count();
        return $like - $dislike;
    }

    //__________ check if user rate a comment or not
    static function user_comment_rate($id){
        $user_id=Session::get('user')['id'];
        $rate=comments_rate::where(['user_id'=>$user_id , 'comment_id'=>$id])->first();
        return $rate;
    }
}
