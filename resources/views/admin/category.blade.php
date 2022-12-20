<!DOCTYPE html>
<html lang="en">
  <head>
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
                    <h2 class="h2_font">Pridėti prekės kategorija</h2>
                        <form action="{{url('/add_category')}}" method="POST">
                            @csrf
                            <input class="input_color" type="text" name="category" placeholder="Kategorijos pavadinimas">
                            <input type="submit" class="btn btn-primary" name="Sumbit" value="Pridėti kategorija">
                        </form> 
                </div>

                <table class="center">
                        <tr>
                           <td>Kategorijos pavadinimas</td> 
                           <td>Veiksmas</td>
                           @foreach($data as $data)
                            <tr>
                            <td>{{$data->category_name}}</td>  
                            <td><a onclick ="return confirm('Ar tikrai norite pašalinti šią kategoriją?' )" class="btn btn-danger" href="{{url('/delete_category',$data->id)}}">Delete</a></td>  
                            </tr>
                        </tr>

                        @endforeach
                </table>
    
        </div>
            </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>