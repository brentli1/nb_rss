<!DOCTYPE html>
<html>
  <head>
    <title>Codebrent</title>
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
    <script src="/js/app.js"></script>
    @stack('js_footer')
  </body>
</html>
