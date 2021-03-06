<!DOCTYPE html>
<html>
  <head>
    <title>NBRSS</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/css/app.css">
    @stack('css_head')
    @stack('js_head')
  </head>
  <body>
    <!-- Navigation -->
    @include('site.main_nav')

    <!-- Main Body -->
    <section class="main-body">
      @yield('content')
    </section>

    <!-- Javascripts -->
    @stack('js_footer')
  </body>
</html>