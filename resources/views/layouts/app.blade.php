<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{-- meta  --}}
<title>@yield('title') {{ config('app.name', 'Laravel') }} - {{__('Delicious Burgers & Fresh Food | Best Online Burger Shop')}}</title>
{{-- <meta name="title" content="{{__('Delicious Burgers & Fresh Food | Best Online Burger Shop')}}">
<meta name="description" content="{{__('Order the most delicious, juicy burgers and fresh food online. We serve mouthwatering burgers made from high-quality ingredients — fast delivery and unbeatable taste!')}}">
<meta name="keywords" content="{{__('burgers, burger shop, online burger delivery, delicious burgers, cheeseburgers, gourmet burgers, fast food, best burgers, fresh food, burger restaurant, burger takeaway')}}">
 <meta property="og:image" content="{{asset('ico/favicon-32x32.png')}}"> --}}
{{--  --}}
    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('ico/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('ico/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('ico/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('ico/site.webmanifest')}}">
<meta name="theme-color" content="#000000">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
     {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
     <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ uniqid() }}">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    @livewireStyles
</head>

<body>
    <div id="app">
        @include('inc.navbar')
        {{-- sidebar --}}
        {{-- <div id="snav" class="sidenav">
            <div class="nv-wrap">
                @livewire('shop.cartlist')
               
            </div>
        </div> --}}
        {{-- sidebar end --}}
        <div style="height:100px"></div>

        <main class="container" style="min-height: 100vh; margin-bottom:100px">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @yield('content')
                </div>
            </div>
        </main>
       
        <footer class="text-center py-3 d-flex justify-content-center align-items-center" style="height:150px">
  <div class="container ">
    <div><strong>{{ __('Open Hours')}}</strong></div>
    <div><strong>{{ __('Monday to Friday 11:00 – 17:00')}}</strong></div>
    {{-- <div><strong>{{ __('Saturday 10:00 – 12:00')}}</strong></div> --}}
    <div class="mb-3">{{__('For support, contact')}} <a href="mailto:info@mbrothers-food.com" class="text-white">info@mbrothers-food.com</a></div>
    <div class="gray-5">&copy;  {{ date('Y') }} {{ config('app.name') }}. {{__('All rights reserved.')}}</div>
  </div>
</footer>
{{--  notice modal--}}
  @php
            $status = App\Models\ShopStatus::whereDate('closing_date', today())
                ->where('status_name', 'closed')
                ->first();
        @endphp
        @if ($status)
        <div class="fixed-bottom">
            <div class="notice">
                <p>{{ $status->status_color}}</p>
            </div>
        </div>
        @endif

         {{-- <div class="fixed-bottom">
            <div class="notice">
                <p><strong>Obavijest:</strong> Dana 31.12.2025. radno vrijeme je od 09:00 do 12:00.</p>
            </div>
        </div> --}}
{{--  --}}

        {{--  --}}

        {{-- cookies --}}
        @include('inc.cookie')
        {{--  --}}
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    {{-- sidebar --}}
  
    
    <script>
         window.addEventListener('pop', event => {
           const element = document.querySelector('.cart-icon');
        element.classList.add('cart-pop');
        setTimeout(() => element.classList.remove('cart-pop'), 500); // remove after animation
        });
        
    </script>
    <script>
         window.addEventListener('shrink', event => {
           const element = document.querySelector('.cart-icon');
        element.classList.add('cart-shrink');
        setTimeout(() => element.classList.remove('cart-shrink'), 500); // remove after animation
        });
        
    </script>
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    const cookieBar = document.getElementById("cookieConsent");
    const acceptBtn = document.getElementById("acceptCookies");
    const declineBtn = document.getElementById("declineCookies");

    if (!localStorage.getItem("cookieConsent")) {
      cookieBar.style.display = "flex";
    }

    acceptBtn.addEventListener("click", function() {
      localStorage.setItem("cookieConsent", "accepted");
      cookieBar.style.display = "none";
    });

    declineBtn.addEventListener("click", function() {
      localStorage.setItem("cookieConsent", "declined");
      cookieBar.style.display = "none";
    });
  });
</script>
    {{-- sidebar --}}
    <script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
      .then(function(registration) {
        console.log('Service Worker registered with scope:', registration.scope);
      }).catch(function(error) {
        console.log('Service Worker registration failed:', error);
      });
  }
</script>
</body>

</html>
