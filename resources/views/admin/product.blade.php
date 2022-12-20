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
                    <h2 class="h2_font">Pridėti Prekę</h2>

<form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
@csrf
                    <div class="div_design">
                            <label>Prekės pavadinimas: </label>
                            <input class="input_color" type="text" name="title" placeholder="Pavadinimas" required="">
                    </div>

                    <div class="div_design">
                            <label>Prekės aprašymas: </label>
                            <input class="input_color" type="text" name="description" placeholder="Aprašymas" required="">
                    </div>

                    <div class="div_design">
                            <label>Prekės kaina(€): </label>
                            <input class="input_color" type="number" name="price" placeholder="Kaina" required="">
                    </div>

                    <div class="div_design">
                            <label>Nuolaidos dydis(€): </label>
                            <input class="input_color" type="number" name="discount_price" placeholder="Nuolaida">
                    </div>

                    <div class="div_design">
                            <label>Prekės kiekis: </label>
                            <input class="input_color" type="number" min="0" name="quantity" placeholder="Kiekis" required="">
                    </div>

                    <div class="div_design">
                            <label>Prekės kategorija: </label>
                            <select class="input_color" name="category"  required="">
                            <option value="" selected="">Pasirinkti kategorija</option>
                            @foreach($category as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                            </select>
                    </div>

                    <div class="div_design">
                            <label>Prekės vaizdas:</label>
                            <input type="file" name="image" placeholder="Upload product image" required="">
                    </div>
                    <div class="div_design">
                        <input type="submit" class="btn btn-primary" name="Sumbit" value="Pridėti prekę">
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