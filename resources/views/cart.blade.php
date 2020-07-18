@extends('layout.layout')

@section('title')
    Shopping Cart
@endsection

@section('css')
@parent
    <link href="{{asset('/')}}css/custom.css" rel="stylesheet">
@endsection

@section('content')
    <div id="block1">
        <h2>This is your shopping Cart!</h2>                
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Product</th>
                    <th scope="col">Contains</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody id="cart">
                    
                </tbody>
            </table>
        <i>Delivery service costs are free over a 15$ order price.</i>
        <hr>
        <div><h5 id="countDolar">In total: $</h5></div>
        <div><h5 id="countEuro">In total: &euro;</h5></div>
        <hr>
        <div id="noRegister">  
            <h4 class="text-info">Your personal information for the delivery</h4>
            <div class="form-group">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" onKeyUp="regularFirstName()">
            </div>
            <div class="form-group">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" onKeyUp="regularLastName()">
            </div>
            <div class="form-group">
                <input type="text" id="address" name="address" class="form-control" placeholder="Address" onKeyUp="regularAddress()">
            </div>
            <div class="form-group">
                <input type="text" id="email_address" name="email_address" class="form-control" placeholder="Email address" onKeyUp="regularEmail()">
            </div>
            <div class="form-group">
                <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Mobile number" onKeyUp="regularMobileNumber()">
            </div>
            <button type="button" onClick="order()" class="btn btn-primary btn-lg btn-block" id="order">Order your Pizzas</button>
        </div>
        <span>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </span>
        <hr>
        <i>All orders are saved in our database.</i>
        <hr>
        <h5 id="messagge"></h5>
    </div>
@endsection

@section('js')
@parent
    <script src="{{asset('/')}}js/app.js" onLoad="cart()"></script>
@endsection