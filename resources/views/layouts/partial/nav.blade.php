
<div class="profile">
<ul class="navbar-nav ml-auto">

  @guest
                           @if (Route::has('register'))
    
                           
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                     <b>Sign in</b></a>
                                      
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              <b>{{ Auth::user()->name }} </b><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                  <a class="dropdown-item" href="{{ route('myOrders') }}" > {{ __('My Orders') }} </a>
                                  <hr>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                     
                                    
                                    </a>






                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>



                            </li>
                        @endguest

</ul>
</div>


<div id="page">
    <nav class="colorlib-nav" role="navigation">
      <div class="top-menu">
        <div class="container">
          <div class="row">
            <div class="site-name col-sm-7 col-md-9">
              <div id="colorlib-logo"><a href='#'>Emart</a></div>
            </div>
            <div class="col-sm-5 col-md-3">
                  
                  <form action="{{ route('search')}}" class="search-wrap" method="Get">
                     <div class="form-group">
                        <input type="search" name="search" class="form-control search" placeholder="Search">
                        <div class="input-group-append">
                        <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
                     </div>
                   </div>
                  </form>
               </div>
             </div>
            <div class="nav-bar">
            <div class="col-sm-12 text-left menu-1">

              <ul>
                   <hr>
                <li class="nav-bar active"><a href="{{ route('front') }}">  Home </a></li>
                <li class="nav-bar has-dropdown">
                  <a href="#">Category</a>
                  <ul class="dropdown">
                    <li><a href="{{ route('art')}}">Art & Crafts</a></li>
                    <li><a href="{{ route('cloth')}}">Clothing</a></li>
                    <li><a href="{{ route('food')}}">Food Items</a></li>
                    <li><a href="{{ route('gift')}}">Gift & Jewellary</a></li>
                    <li><a href="{{ route('living')}}">Home & Living</a></li>
                  </ul>
                </li>
                 <li class="nav-bar has-dropdown"><a href="#">Shops </a>
                  <ul class="dropdown">
                   <li><a href="{{ route('shop1')}}">Fashion Fiesta</a></li>
                   <li><a href="{{ route('shop2')}}">Gifts and Glam</a></li> 
                   <li><a href="{{ route('shop3')}}">Healthy Treat</a></li>
                  </ul></li>
                <li class="nav-bar active"><a href="{{ route('about')}}">About</a></li>
                <li class="nav-bar active"><a href="{{ route('contact')}}"><i class="fa fa-fw fa-envelope"></i>Contact</a></li>
               @php
               $total=App\Cart::all()->where('user_id',Auth::id())->where('user_ip',request()->ip())->sum
               (function($t){
               return $t->price*$t->quantity;
             });
                     $quantity=App\Cart::where('user_ip',request()->ip())->where('user_id',Auth::id())->sum('quantity');

                      $q=App\Wishlist::where('user_id',Auth::id())->where('user_ip',request()->ip())->sum('quantity');

             

               @endphp
               
                           
              <li class="cart"><a href="{{ url('cart')}}"><i class="icon-shopping-cart"></i> Cart({{ $quantity}})</a></li>
              <li class="cart"><a href="{{route('page.wishlist')}}"><i class="fa fa-heart" style="font-size: 17px"></i>
              Wishlist({{$q}})</a></li>
                      

              
              
              
              </ul>
            </div>
          </div>
        </div>
     
     </div>
      <div class="sale">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center">
              <div class="row">
                <div class="owl-carousel2">
                  <div class="item">
                    <div class="col">
                      <h3><a href="#">Get 25% discount using your coupon code</a></h3>
                    </div>
                  </div>
                  <div class="item">
                    <div class="col">
                      <h3><a href="#">Our biggest sale yet 50% off all winter products</a></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>