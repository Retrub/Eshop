<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">
        .center
        {
            margin: auto;
            width: 60%;
            text-align:center;

        }
        table,th,td
        {
            border: 1px solid black;
            text-align:center;
            margin-left: auto;
            margin-right: auto;
        }
        .th_design
        {
            font-size:30px;
            padding:5px;
            background: #FB4040;
        }
        .message_color
    {
        background-color:#6ED683;
    }
    
      </style>
   </head>
   <body>
      <div class="hero_area">

                 <!-- start header section -->
                 @include('home.header')
                          <!-- end header section -->

                          @if(session()->has('message'))
                <div class=" message_color alert alert_success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
                            @endif

        <div class="center">
            <table>
                <tr>
                    <th class="th_design">Pavadinimas</th>
                    <th class="th_design">Kiekis</th>
                    <th class="th_design">Vnt. Kaina</th>
                    <th class="th_design">Nuotrauka</th>
                    <th class="th_design">Iš viso</th>
                    <th class="th_design">Veiksmas</th>
                </tr>
                <?php $totalprice=0; $one_price=0; ?>
                @foreach($cart as $cart)
                <tr>
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$one_price=$cart->price/$cart->quantity}}€</td>
                    <th><img style="width:100px;height:100px;text-align:center;" src="{{ asset('/product_images/'.$cart->image) }}" alt=""></th>
                    <td>{{$cart->price}}€</td>
                    <td><a class="btn btn-danger" href="{{url('/remove_cart', $cart->id)}}" onclick ="return confirm('Ar tikrai norite pašalinti prekę?')" >Pašalinti</a></td>
                </tr>
                <?php $totalprice=$totalprice + $cart->price*$cart->quantity ?>
                @endforeach

            </table>
            <div>
                <h1 style="font-size:20px; font-weight:bold; padding:20px;">Suma: {{$totalprice}}€</h1>
            </div>

            <div style="padding: 20px;">
            <h1 style="font-size:20px; font-weight:bold; padding-bottom: 25px;">Apmokėjimo būdai:</h1>
            <a href="{{url('/cash_order')}}" class="btn btn-primary">Grynaisiais pinigais</a>
            <a href="" class="btn btn-primary">Banko kortele</a>
            </div>
        </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->

      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>