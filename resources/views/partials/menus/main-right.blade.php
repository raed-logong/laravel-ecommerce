<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<meta name="csrf-token" content="{{csrf_token()}}">
<div id="app">
<ul>




    @guest
    <li><a href="{{ route('register') }}">Sign Up</a></li>
    <li><a href="{{ route('login') }}">Login</a></li>
    @else
        <li class="nav-item dropdown " >

            <a class="dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Products
            </a>
            <div class="dropdown-menu"  style="background-color: #1a1f21" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('product.create') }}">Add Products</a>
                <a class="dropdown-item" href="#">My Products</a>
            </div>
        </li>
        <li class="nav-item dropdown " >

            <a class="dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{auth()->user()->name}}

                <img src="{{productImage(auth()->user()->profile->image)}}" class="d-inline-block align-top rounded-circle" alt="{{asset('poly.png')}}" width="30" height="30" >    </img>
            </a>
            <div class="dropdown-menu"  style="background-color: #1a1f21" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('users.edit') }}">My Account</a>
                <a class="dropdown-item" href="{{ route('orders.index') }}">My Orders</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    Logout

                </a>
            </div>
        </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}

    </form>
        <li><a href="{{ route('cart.index') }}">Cart
                @if (Cart::instance('default')->count() > 0)
                    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
                @endif
            </a></li>
        {{--notification--}}
        <notification :userid="{{auth()->id()}}" :unreads="{{auth()->user()->unreadNotifications->sortByDesc('created_at')}}"></notification>


    @endguest

</ul>
</div>