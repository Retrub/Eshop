<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="{{ asset('public/') }}">
  @include('admin.css')
  <style type="text/css">
    .div_center
    {
        text-align:center;
        padding-top:40px;
    }
    .h2_font
    {
        font-size:40px;
        padding-bottom:40px;
    }
    .input_color
    {
        color:black;
        padding-bottom: 20px;
    }

    .message_color
    {
        background-color:#6ED683;
    }
    
    .center
    {
        margin:auto;
        width:30%;
        text-align:center;
        margin-top:30px;
        border:3px solid white;

    }
    label
    {
        display:inline-block;
        width:200px;
    }
    .div_design
    {
        padding-bottom:15px;
    }
  </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

            @if(session()->has('message'))
                <div class=" message_color alert alert_success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}

                </div>

            @endif

                <div class="div_center">
                    <h2 class="h2_font">Update Product</h2>

<form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
@csrf
                    <div class="div_design">
                            <label>Product Title: </label>
                            <input class="input_color" type="text" name="title" placeholder="Write a title" required="" value="{{$product->title}}">
                    </div>

                    <div class="div_design">
                            <label>Product Description: </label>
                            <input class="input_color" type="text" name="description" placeholder="Write a description" required="" value="{{$product->description}}">
                    </div>

                    <div class="div_design">
                            <label>Product Price: </label>
                            <input class="input_color" type="number" name="price" placeholder="Write a price" required="" value="{{$product->price}}">
                    </div>

                    <div class="div_design">
                            <label>Discount Price: </label>
                            <input class="input_color" type="number" name="discount_price" placeholder="Write a discount price" value="{{$product->discount_price}}">
                    </div>

                    <div class="div_design">
                            <label>Product Quantity: </label>
                            <input class="input_color" type="number" min="0" name="quantity" placeholder="Write a quantity" required="" value="{{$product->quantity}}">
                    </div>

                    <div class="div_design">
                            <label>Product Category: </label>
                            <select class="input_color" name="category" placeholder="Chose a category" required="">
                            <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                            @foreach($category as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                            </select>
                    </div>

                    <div class="div_design">
                            <label>Current Product Image: </label>
                            <img style="margin:auto;" height="150px" width="150px" src="{{ asset('/product_images/'.$product->image) }}">
                    </div>

                    <div class="div_design">
                            <label>Change Product Image: </label>
                            <input type="file" name="image"  >
                    </div>
                    <div class="div_design">
                        <input type="submit" class="btn btn-primary" name="Sumbit" value="Update Product">
                    </div>
                </div>
</form>
        </div>
            </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>