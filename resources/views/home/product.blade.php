<style type="text/css">
</style>

<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Produktų <span>sąrašas</span>
               </h2>
               <div>

                        <form action="{{url('product_search')}}" method="GET">
                           @csrf
                           <input type="text" name="search" placeholder="Paieška">
                           <button class="btn nav_search-btn fa fa-search" type="submit" aria-hidden="true"> </button>
                        </form>
               </div>
               @if(session()->has('message'))
                <div class=" message_color alert alert_success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}

                </div>

            @endif
            </div>
            <div class="row">
               @foreach($product as $products)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('/product_details',$products->id)}}" class="option1">
                           Aprašymas
                           </a>
                           <form action="{{url('add_cart', $products->id)}}" method="Post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-7">
                                    <input type="submit" value="Įdėti į krepšelį">
                                 </div>

                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="height:52px;">
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{ asset('/product_images/'.$products->image) }}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>

                        @if($products->discount_price!=null)
                        <h6 style="color: red;">
                        Kaina su nuolaida
                        <br>
                        {{$products->discount_price}}€
                        </h6>
                        
                        <h6 style="text-decoration: line-through;color:blue;">
                        {{$products->price}}€
                        Kaina
                        <br>
                        </h6>
                        @else
                        <h6 style="color:blue;">
                        Kaina
                        <br>
                        {{$products->price}}€
                        </h6>
                        @endif
                     </div>
                  </div>
               </div>
               @endforeach
               <span style="padding-top: 3px;">
               {!!$product->withQueryString()->links('pagination::bootstrap-4')!!}
               </span>
            <!-- <div class="btn-box">
               <a href="">
               View All products
               </a>
            </div> -->

         </div>
      </section>