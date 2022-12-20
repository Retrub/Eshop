<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
  <style type="text/css">
    .img_size
    {
        width:150px;
        height:150px;
    }
    .message_color
    {
        background-color:#6ED683;
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

        <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h2 style="font-size: 30px;">Užsakymai</h2>
                    <div style="padding-top: 20px; padding-bottom: 20px; ">
                      <form action="{{url('/search')}}" method="get">
                        @csrf
                        <input style="color:black;" type="text" name="search" placeholder="Įveskite paieškos žodį">
                        <input type="submit" value="Ieškoti" class="btn btn-outline-primary">
                      </form>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Vardas</th>
                            <th>Paštas</th>
                            <th>Adresas</th>
                            <th>Telefono nr.</th>
                            <th>Prekės pavadinimas</th>
                            <th>Kiekis</th>
                            <th>Kaina</th>
                            <th>Vaizdas</th>
                            <th>Mokėjimo būdas</th>
                            <th>Užsakymo statusas</th>
                            <th>Data</th>
                            <th>Veiksmas</th>
                            <th>PDF failas</th>
                          </tr>
                        </thead>
                        @foreach($order as $orders)
                        <tbody>
                          <tr>
                            <td>
                              <span class="pl-2">{{$orders->name}}</span>
                            </td>
                            <td>{{$orders->email}}</td>
                            <td>{{$orders->address}}</td>
                            <td>{{$orders->phone}}</td>
                            <td>{{$orders->product_title}}</td>
                            <td>{{$orders->quantity}}</td>
                            <td>{{$orders->price}}</td>
                            <td>
                        <img class="img_size" src="{{ asset('/product_images/'.$orders->image) }}">
                            </td>
                            <td>{{$orders->payment_status}}</td>
                            @if($orders->delivery_status=='Pristatytas')
                            <td><div class="badge badge-outline-success">{{$orders->delivery_status}}</div></td>
                            @elseif($orders->delivery_status=='Užsakymas apdorojamas')
                            <td><div class="badge badge-outline-warning">{{$orders->delivery_status}}</div></td>
                            @elseif($orders->delivery_status=='Apmokėtas')
                            <td><div class="badge badge-outline-info">{{$orders->delivery_status}}</div></td>
                            @elseif($orders->delivery_status=='Atšauktas')
                            <td><div class="badge badge-outline-danger">{{$orders->delivery_status}}</div></td>
                            @endif
                            <td>{{$orders->created_at}}</td>
                            <td>
                            @if($orders->delivery_status=='Užsakymas apdorojamas')
                            <a class="btn btn-success" onclick ="return confirm('Ar tikrai norite pakeisti užsakymo statusą?')" href="{{url('paid', $orders->id)}}">Apmokėtas</a>
                            <a class="btn btn-warning" onclick ="return confirm('Ar tikrai norite pakeisti užsakymo statusą?')" href="{{url('delivered', $orders->id)}}">Pristatytas</a>
                            @elseif($orders->delivery_status=='Apmokėtas')
                            <a class="btn btn-warning" onclick ="return confirm('Ar tikrai norite pakeisti užsakymo statusą?')" href="{{url('delivered', $orders->id)}}">Pristatytas</a>
                            @elseif($orders->delivery_status=='Pristatytas')
                            Pakeitimai negalimi
                            @endif
                            </td>
                            <td> <a class="btn btn-secondary" href="{{url('print_pdf', $orders->id)}}">Atsisiųsti</a></td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                      <span style="padding-top: 3px;margin-left:16%;">
               {!!$order->withQueryString()->links('pagination::bootstrap-4')!!}
               </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>