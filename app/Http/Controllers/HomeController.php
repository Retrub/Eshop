<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(6);
        return view('home.userpage',compact('product'));
    }
    
    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype==1)
        {
            $total_product=product::all()->count();
            $total_user=user::all()->count();
            $total_orders=order::all()->count();
            $total_income = order::where('delivery_status', 'Apmokėtas')->orWhere('delivery_status', 'Pristatytas')->sum('price');
            $total_delivery=order::where('delivery_status', 'Pristatytas')->count();
            $total_processed=order::where('delivery_status', 'Užsakymas apdorojamas')->count();
            $total_paid=order::where('delivery_status', 'Apmokėtas')->count();
            $total_income_card = order::where('payment_status', 'Kortele')->where(function($query) {
            $query->where('delivery_status', 'Apmokėtas')->orWhere('delivery_status', 'Pristatytas');})->sum('price');
            $total_income_money= order::where('payment_status', 'Grynaisiais pinigais')->where(function($query) {
                $query->where('delivery_status', 'Apmokėtas')->orWhere('delivery_status', 'Pristatytas');})->sum('price');
            return view('admin.home',compact('total_product','total_user','total_orders','total_income','total_delivery','total_processed','total_income_card','total_income_money','total_paid'));
        }
        else
        {
            $product=Product::paginate(6);
            return view('home.userpage',compact('product'));
        }
    }

    public function product_details($id)
    {

        $product=Product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request, $id)
    {

        if(Auth::id())
        {
            $user=Auth::user();
            $product=Product::find($id);
            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;
            $cart->product_id=$product->id;
            $cart->product_title=$product->title;
            $cart->quantity=$request->quantity;
            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }
            else
            {
                $cart->price=$product->price * $request->quantity;
            }
            $cart->image=$product->image;
            $cart->save();
            return redirect()->back()->with('message', 'Prekė sėkmingai pridėta į krepšelį. ');
        }

        else
        {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
    
            return view('home.show_cart',compact('cart'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {

        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message', 'Prekė sėkmingai pašalinta iš krepšelio. ');
    }

    public function cash_order()
    {
        $userid=Auth::user()->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->price=$data->price;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='Grynaisiais pinigais';
            $order->delivery_status='Užsakymas apdorojamas';
            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'Užsakymas gautas. Apmokėjimo informacija išsiustą el. paštu. ');

    }

    public function show_order()
    {

        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=', $userid)->paginate(10);
            return view('home.order',compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order=order::find($id);
        $order->delivery_status="Atšauktas";
        $order->save();
        return redirect()->back()->with('message', 'Užsakymas sėkmingai atšauktas ');
    }

    public function product_search(Request $request)
    {
        $seacrh_input=$request->search;
        $product=product::where('title','LIKE',"%$seacrh_input%")->orWhere('category','LIKE',"%$seacrh_input%")->paginate(6);

        if($product->isEmpty())
        {
            $product=product::all();
            return redirect()->back()->with('message', 'Pagal įvesta raktažodį nieko rasti nepavyko');
        }
        return view('home.userpage',compact('product'));
    }

    
    public function products(Request $request)
    {
        $seacrh_input=$request->search;
        $product=product::where('title','LIKE',"%$seacrh_input%")->orWhere('category','LIKE',"%$seacrh_input%")->paginate(12);

        if($product->isEmpty())
        {
            $product=product::all();
            return redirect()->back()->with('message', 'Pagal įvesta raktažodį nieko rasti nepavyko');
        }
        return view('home.products',compact('product'));
    }
}
