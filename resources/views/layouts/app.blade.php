<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">

    <title>@yield('title')</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{{ config('app.name', 'LARAVEL') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/weather">Погода в Брянске</a></li>
        <li><a href="/orders">Заказы</a></li>
        <li><a href="/products">Продукты</a></li>        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
            
            </div>
        </div>
        <div class="row">
              <div class="col-md-10 col-md-offset-1">@yield('content')</div>
        </div>
        
    </div>

    <!-- Optional JavaScript -->
    <script src="/js/app.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>
