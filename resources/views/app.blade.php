<!DOCTYPE html>
<html>
  <head>
    <title>NBRSS</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <div class="site-wrapper">
      <!-- Navigation -->
      @include('site.main_nav')

      <!-- Main Body -->
      <div id="app" class="main-body">
        <router-view keep-alive transition transition-mode="out-in">
        </router-view>
      </div>
    </div>

    <!-- Javascripts -->
    <script src="/js/app.js"></script>
  </body>
</html>
