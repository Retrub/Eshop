<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')

  <style type="text/css">
    .div_center
    {
        text-align:center;
    }
    .h2_font
    {
        font-size:40px;
    }
    
    .center
    {
        margin:auto;
        width:80%;
        text-align:center;
        margin-top:40px;
        border:2px solid white;

    }
    .message_color
    {
        background-color:#6ED683;
    }
    .div_design
    {
        padding-bottom:15px;
    }
    .img_size
    {
        width:150px;
        height:150px;
    }
    .th_design
    {
        background:#6FD884;
        height:50px;
        width: 50px;
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
                    <h2 class="h2_font">Produktų sąrašas</h2>
            <table class="center">
                <tr class="th_design">
                    <th>Pavadinimas</th>
                    <th>Aprašymas</th>
                    <th>Kiekis</th>
                    <th>Kategorija</th>
                    <th>Kaina</th>
                    <th>Kaina su nuolaida</th>
                    <th>Vaizdas</th>
                    <th>Veiksmas</th>
                </tr>
                @foreach($product as $products)
                <tr class="td_design">
                    <td style="width:60px;">{{$products->title}}</td>
                    <td style="width:500px;">{{$products->description}}</td>
                    <td style="width:40px;">{{$products->quantity}}</td>
                    <td style="width:80px;">{{$products->category}}</td>
                    <td style="width:40px;">{{$products->price}}€</td>
                    @if($products->discount_price !=null)
                    <td style="width:40px;">{{$products->discount_price}}€</td>
                    @else
                    <td style="width:40px;">Nuolaida netaikoma</td>
                    @endif
                    <td style="width:130px;">
                        <img class="img_size" src="{{ asset('/product_images/'.$products->image) }}">
                    </td>
                    <td style="width:120px;">
                        <a class="btn btn-danger" onclick ="return confirm('Ar tikrai norite pašalinti produktą?')" href="{{url('delete_product', $products->id)}}">Delete</a>
                        <a class="btn btn-success" href="{{url('update_product', $products->id)}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <span style="padding-top: 40px;">
               {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
               </span>
        </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>