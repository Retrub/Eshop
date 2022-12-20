<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Užsakymas</title>

    <style type="text/css">
    .img_size
    {
        width:150px;
        height:150px;
    }
  </style>
</head>
<body>
    
<h2 style="text-align:center;">Užsakymo suvestine:</h2>
<h3>Kliento duomenys:</h3>
<p>Vardas: {{$order->name}}</p>
<p>Paštas: {{$order->email}}</p>
<p>Telefono nr.: {{$order->phone}}</p>
<p>Adresas: {{$order->address}}</p>

<h3>Prekiu sarašas:</h3>
<p>Pavadinimas: {{$order->product_title}}</p>
<p>Kiekis: {{$order->quantity}}</p>
<p>Kaina: {{$order->price}}€</p>
<p>Vaizdas:</p><img class="img_size" src="{{ asset('/product_images/'.$order->image) }}">
<p>Apmokejimo budas: {{$order->payment_status}}</p>
</body>
</html>