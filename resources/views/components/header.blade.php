<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{csrf_token()}}">

  <title>@yield('title') | The Yummi Pizza</title>

  @section('css')
  <link href="{{asset('/')}}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('/')}}css/shop-homepage.css" rel="stylesheet">
  @show

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{asset('/')}}">The Yummi Pizza</a>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{asset('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{asset('/cart')}}">Shoping Cart</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>