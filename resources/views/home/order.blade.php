<!DOCTYPE html>
<html>
   <head>
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

      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('/images/logo2.png')}}" type="">
      <title>PARTSCAN el. parduotuvė</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">

         <!-- start header section -->
         @include('home.header')
         <!-- end header section -->
<h1 style="font-size:30px;font-weight:bold;margin-left:16%;">Užsakymo nr. 159975</h1>
         <table>
                <tr>
                    <th class="th_design">Pavadinimas</th>
                    <th class="th_design">Kiekis</th>
                    <th class="th_design">Vnt. Kaina</th>
                    <th class="th_design">Nuotrauka</th>
                    <th class="th_design">Iš viso</th>
                    <th class="th_design">Apmokėjimo būdas</th>
                    <th class="th_design">Būsena</th>
                    <th class="th_design">Veiksmas</th>
                </tr>
                @foreach($order as $orders)
                <tr>
                    <td>{{$orders->product_title}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{{$one_price=$orders->price/$orders->quantity}}€</td>
                    <th><img style="width:100px;height:100px;text-align:center;" src="{{ asset('/product_images/'.$orders->image) }}" alt=""></th>
                    <td>{{$orders->price}}€</td>
                    <td>{{$orders->payment_status}}</td>
                    <td>{{$orders->delivery_status}}</td>
                    @if($orders->delivery_status=="Užsakymas apdorojamas" or  $orders->delivery_status=="Apmokėtas" )
                    <td><a class="btn btn-danger" href="{{url('/cancel_order', $orders->id)}}" onclick ="return confirm('Ar tikrai norite atšaukti užsakymą?')" >Atšaukti</a></td>
                    @else
                    <td style="text-align:center;">Atlikti<br>pakeitimų</br>nebegalima</td>
                    @endif
                </tr>
                @endforeach
</table>
                <span style="padding-top: 3px;margin-left:16%;">
               {!!$order->withQueryString()->links('pagination::bootstrap-4')!!}
               </span>

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