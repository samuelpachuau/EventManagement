<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title","EventManager")</title>
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary"></body>>
    
        @yield("content")
    
    <script src="{{ asset("assets/js/bootstrap.min.js)}></script>
  </body>
</html>