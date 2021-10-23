<header>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <div class="top-nav container">
      <div class="top-nav-left">
          <div class="logo"><a href="/">Polycommerce</a></div>
          @if (! (request()->is('checkout') || request()->is('guestCheckout')))
          {{ menu('main', 'partials.menus.main') }}
          @endif
      </div>
      <div class="top-nav-right">
          @if (! (request()->is('checkout') || request()->is('guestCheckout')))
          @include('partials.menus.main-right')
          @endif
      </div>
    </div> <!-- end top-nav -->
</header>
