var baseUrl = '/the_yummi_pizza/';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function onLoad()
{
    getProducts(); 
}

function cart()
{
    getCart();
    countPrice();
}

function getProducts()
{
    $.ajax({
       type: 'GET',
       dataType: 'json',
       url: baseUrl + 'products',
       success: function(data) {                     
           
           var productsData = '';
           for($i=0;$i<data.length;$i++)
           {
               productsData+= '<div class="col-lg-4 col-md-6 mb-4">';
                 productsData+= '<div class="card h-100">';
                   productsData+= '<input type="hidden" id="productId" value="'+ data[$i]["id_product"] +'">';
                   productsData+= '<img class="card-img-top" src="'+ baseUrl+data[$i]["src"] +'" alt="'+ data[$i]["alt"] +'">';
                   productsData+= '<div class="card-body">';
                     productsData+= '<h4 class="card-title">';
                       productsData+= '<h4 class="pro">'+ data[$i]["name"] +'<h4>';
                     productsData+= '</h4>';
                     productsData+= '<h5>'+ data[$i]["price"] +'$</h5>';
                     productsData+= '<p class="card-text">'+ data[$i]["text"] +'</p>';
                     productsData+= '<button type="button" class="btn btn-primary" onClick="addToCart('+ data[$i]["id_product"] +')">Add to cart</button>';
                   productsData+= '</div>';
                 productsData+= '</div>';
               productsData+= '</div>';
           }
                     
           $("#app").html(productsData);
       }
    });
}

function addToCart(id)
{
    $.ajax({
        type: 'POST',
        url: baseUrl + 'addToCart/'+ id,
        data: {
            product_id: id
        },
        success: function()
        {
             if(confirm("Go to your shopping cart ?"))
             {
                 location.href = baseUrl + "cart";
             }
        },
        error: function(error)
        {
             console.log(error);
        }
     });
}

function deleteCart(id)
{
    if(confirm('Are you sure you want to remove this pizza from your order?'))
    {
       $.ajax({
       type: 'GET',
       url: baseUrl + 'deleteCart/' + id,
       success: function() 
       {
           getCart();
           countPrice();
       }
    });
    }
}

function getCart(callback)
{
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: baseUrl + 'cart/getCart',
        success: function(data) {
            var cartData = '';
            $id = 0;
            for($i=0;$i<data.length;$i++)
            {
                cartData+= '<tr>';
                    cartData+='<th scope="row"></th>';
                    cartData+='<td><i>'+ data[$i]["name"] +'</i></td>';
                    cartData+='<td><i>'+ data[$i]["text"].slice(13,100) +'</i></td>';
                    cartData+='<td><i>'+ data[$i]["price"] +'$</i></td>';
                    cartData+='<td><img src="'+ baseUrl + data[$i]["src"] +'" width="80px" height="55px" alt="'+ data[$i]["alt"] +'"/></td>';
                    cartData+='<td><select class="summable" onChange="countPrice(); return false"><option value="'+data[$i]["price"]+'">1</option><option value="'+data[$i]["price"] * 2+'">2</option><option value="'+data[$i]["price"] * 3+'">3</option><option value="'+data[$i]["price"] * 4+'">4</option><option value="'+data[$i]["price"] * 5+'">5</option></select></td>';
                    cartData+='<td><button class="btn btn-danger btn-sm" onClick="deleteCart('+ data[$i]["id_cart"] +'); return false">Delete</button></td>';
                cartData+='</tr>';
            }
            if (typeof callback === 'function') {
                callback(data);
            }
            $("#cart").html(cartData);
        }
    });
}

function countPrice(callback)
{
    $.ajax({
       type: 'GET',
       dataType: 'json',
       url: baseUrl + 'cart/countCart',
       success: function(data) {                           
       
       var dolarData = '';
       var euroData = '';
            
            var totalDrop = 0;
            $.each($(".summable") ,function() {
                totalDrop += parseFloat($(this).val());
            });        
            
            var base = data;            
            var total = totalDrop;
            var str_total = total.toString();
            var dolar = Number(str_total.slice(0, 4));           

            var total2 = total * 0.88;
            var str_total2 = total2.toString();
            var euro = Number(str_total2.slice(0, 4));

            if(total > 15)
            {
                var deliveryDolar = 0;
                var deliveryEuro = 0;
            }
            else
            {
                var deliveryDolar = 7;
                var deliveryEuro = 7 * 0.88;
            }
            
            var base1 = base + deliveryDolar;
            var base2 = base + deliveryEuro;
            
            var totalDolar = dolar + deliveryDolar;
            var str_final = totalDolar.toString();
            var finalDolar = Number(str_final.slice(0, 4));
            
            var totalEuro = euro + deliveryEuro;
            var str_final2 = totalEuro.toString();
            var finalEuro = Number(str_final2.slice(0, 4));
            
            var ternary1 = dolar ? dolar : base;
            var ternary2 = euro ? euro : base * 0.88;
            
            var ternary3 = finalDolar ? finalDolar : base1;
            var ternary4 = finalEuro ? finalEuro : base2;
            
            dolarData+= '<div><h5 id="button1">Price in $: '+ ternary1 +' + delivery costs: '+ deliveryDolar +'<span> | Total price: '+ ternary3 +'$</span></h5></div>';
            euroData+= '<div><h5 id="button1">Price in &euro;: '+ ternary2 +' + delivery costs: '+ deliveryEuro +'<span> | Total price: '+ ternary4 +'&euro;</span></h5></div>';
            
            if (typeof callback === 'function') {
                callback(data);
            }
            $("#countDolar").html(dolarData);
            $("#countEuro").html(euroData);
      }
   });
}

function order()
{
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var address = document.getElementById('address').value;
    var email_address = document.getElementById('email_address').value;
    var mobile_number = document.getElementById('mobile_number').value;
    
    countPrice(function(data1){
        
        getCart(function(data2){

        var orderData = '';
        for($i=0;$i<data2.length;$i++)
        {
            orderData+= data2[$i]["name"] + "*";
        }
        
        if(orderData != 0)
        {
            orderData;
        }
        else
        {
            alert('Add some Pizza to cart in order to order!');
            return;
        }
        
        if(first_name != '' && last_name != '' && address != '' && email_address != '' && mobile_number != 0)
        {
            first_name;
            last_name;
            address;
            email_address;
            mobile_number;
        }
        else
        {
            alert('Some of the field/s of order information is empty!');
            return;
        }
        
        var totalDrop = 0;
        $.each($(".summable") ,function() {
            totalDrop += parseFloat($(this).val());
        });        

        var base = data1;            
        var total = totalDrop;
        var str_total = total.toString();
        var dolar = Number(str_total.slice(0, 4));

        if(total > 15)
        {
            var deliveryDolar = 0;
        }
        else
        {
            var deliveryDolar = 7;
        }

        var base1 = base + deliveryDolar;

        var totalDolar = dolar + deliveryDolar;
        var str_final = totalDolar.toString();
        var finalDolar = Number(str_final.slice(0, 4));                       

        var ternary = finalDolar ? finalDolar : base1;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: baseUrl + 'order',
                data: {
                    order: orderData,
                    first_name: first_name,
                    last_name: last_name,
                    address: address,
                    email_address: email_address,
                    mobile_number: mobile_number,
                    total_price: ternary
                },
                success: function()
                {
                    alert('Thank you for your order.');
                    $("#messagge").html(orderData+' | *'+first_name+' '+last_name+'* | *'+address+'* | *'+email_address+'* | *'+mobile_number+'* | *'+ ternary+'$');
                    $("#first_name").val('');
                    $("#last_name").val('');
                    $("#address").val('');
                    $("#email_address").val('');
                    $("#mobile_number").val('');
                    cartDelete();
                },
                error: function(error)
                {
                    console.log(error);
                }
            });
        });
    });
}

function cartDelete()
{
    $.ajax({
    type: 'GET',
    url: baseUrl + 'cart/delete',
    success: function()
    {
        cart();
    },
    error: function(error)
    {
        console.log(error);
    }
    });
}

function regularFirstName()
{
	var fName = document.getElementById('first_name').value;
	var regFName = /^[A-Z]{1}[a-z]{2,20}$/;
	var name = document.getElementById('first_name').style;
        
	if(!regFName.test(fName))
	{
		name.color = 'red';
                name.border = '2px solid red';
	}
	else
	{
		name.border = '2px solid #17A2B8';
		name.color = '#17A2B8';
	}
}
function regularLastName()
{
	var lName = document.getElementById('last_name').value;
	var regLName = /^[A-Z]{1}[a-z]{4,25}$/;
        var lname = document.getElementById('last_name').style;
	
	if(!regLName.test(lName))
	{
		lname.color = 'red';
                lname.border = '2px solid red';
	}
	else
	{
		lname.border = '2px solid #17A2B8';
		lname.color = '#17A2B8';
	}
}
function regularEmail()
{
	var email = document.getElementById('email_address').value;
	var regEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        var mail = document.getElementById('email_address').style;
	
	if(!regEmail.test(email))
	{
		mail.color = 'red';
                mail.border = '2px solid red';
	}
	else
	{
		mail.border = '2px solid #17A2B8';
		mail.color = '#17A2B8';
	}
}
function regularAddress()
{
	var address = document.getElementById('address').value;
	var regAddress = /^[\w\d\s]{3,30}$/;
        var place = document.getElementById('address').style;
	
	if(!regAddress.test(address))
	{
		place.color = 'red';
                place.border = '2px solid red';
	}
	else
	{
		place.border = '2px solid #17A2B8';
		place.color = '#17A2B8';
	}
}
function regularMobileNumber()
{
	var mobile = document.getElementById('mobile_number').value;
	var regMobile = /^[\d\s]{5,20}$/;
        var phone = document.getElementById('mobile_number').style;
	
	if(!regMobile.test(mobile))
	{
		phone.color = 'red';
                phone.border = '2px solid red';
	}
	else
	{
		phone.border = '2px solid #17A2B8';
		phone.color = '#17A2B8';
	}
}
