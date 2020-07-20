@extends('layout.layout')

@section('title')
    Home
@endsection

@section('css')
@parent
    <link href="{{asset('/')}}css/custom.css" rel="stylesheet">
@endsection

@section('content')

<h1 class="menu">Menu</h1>

<div class="row">

   <div class="col-lg-12">       

     <div class="row" id="app">
         
     </div>

   </div>

 </div>

@section('js')
@parent
    <script src="js/app.js" onLoad="onLoad()"></script>
@endsection

@endsection
