<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;

class AdminController extends Controller
{
    public function view_category()
    {

        $data=category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category added successfully');


    }
    public function delete_category($id)
    {
        $data=category::find($id);
        $data->delete();
 
        return redirect()->back()->with('message', 'Category deleted successfully');
    }
    public function view_product()
    {

        $category=category::all();
        return view('admin.product',compact('category'));
    }
    public function add_product(Request $request)
    {

        $product=new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product_images', $imagename);
        $product->image=$imagename;
        $product->save();
        return redirect()->back()->with('message', 'Product added successfully');
    }

    public function show_product()
    {

        $product=Product::paginate(5);
        return view('admin.show_product',compact('product'));
    }

    public function delete_product($id)
    {
        $product=product::find($id);
        $product->delete();
 
        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function update_product($id)
    {
        $product=Product::find($id);
        $category=Category::all();
 
        return view('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $product=product::find($id);
        $category=category::all();

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;
        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product_images', $imagename);
            $product->image=$imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product updated successfully');
    }

    
    public function order()
    {
        $order=order::paginate(10);
        return view('admin.order',compact('order'));
    }

    public function delivered($id)
    {
        $order=order::find($id);
        $order->delivery_status="Pristatytas";
        $order->save();
        return redirect()->back()->with('message', 'Statusas sėkmingai pakeistas');
    }

    public function paid($id)
    {
        $order=order::find($id);
        $order->delivery_status="Apmokėtas";
        $order->save();
        return redirect()->back()->with('message', 'Statusas sėkmingai pakeistas');
    }

    public function print_pdf($id)
    {
        $order=order::find($id);
        $pdf = PDF::loadView('admin.pdf_file',compact('order'));

        return $pdf->download('Uzsakymas.pdf');
    }

    public function search_order(Request $request)
    {
        $searchText=$request->search;
        $order=order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('address','LIKE',"%$searchText%")->orWhere('delivery_status','LIKE',"%$searchText%")->get();
        if($order->isEmpty())
        {
            $order=order::all();
            return redirect()->back()->with('message', 'Pagal įvesta raktažodį nieko rasti nepavyko');
        }
        return view('admin.order',compact('order'));
    }


}
