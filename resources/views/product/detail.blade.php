<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>{{ $product->name }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
font-family: Arial, sans-serif;
background:#fafafa;
margin:0;
}

/* HEADER */

.header{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 60px;
background:white;
border-bottom:1px solid #eee;
}

.logo{
font-weight:bold;
font-size:20px;
}

.nav a{
margin-left:30px;
text-decoration:none;
color:#333;
}

/* CONTAINER */

.container{
max-width:1200px;
margin:40px auto;
padding:20px;
}

/* BACK */

.back{
margin-bottom:20px;
color:#666;
text-decoration:none;
display:inline-block;
}

/* PRODUCT LAYOUT */

.product{
display:grid;
grid-template-columns:1fr 1fr;
gap:40px;
background:white;
padding:30px;
border-radius:25px;
}

/* IMAGE */

.product-image img{
width:100%;
border-radius:10px;
}

/* INFO */

.product-info h1{
margin-top:0;
font-size:28px;
}

.category{
color:#777;
margin-bottom:10px;
}

.price{
color:#2563eb;
font-size:26px;
font-weight:bold;
margin:15px 0;
}

.description{
color:#555;
line-height:1.6;
}

/* OPTIONS */

.option-title{
margin-top:20px;
font-weight:bold;
}

.options{
margin-top:10px;
}

.options button{
padding:10px 18px;
margin-right:10px;
border:1px solid #ddd;
background:white;
border-radius:8px;
cursor:pointer;
}

.options button:hover{
border-color:#2563eb;
color:#2563eb;
}

/* QUANTITY */

.quantity{
display:flex;
align-items:center;
margin-top:20px;
}

.quantity button{
width:35px;
height:35px;
border:none;
background:#eee;
font-size:18px;
cursor:pointer;
}

.quantity input{
width:50px;
text-align:center;
border:1px solid #ddd;
height:35px;
}

/* BUTTON */

.actions{
margin-top:25px;
display:flex;
gap:15px;
}

.add-cart{
flex:1;
padding:14px;
background: #1035d6;
border:none;
color:white;
border-radius:8px;
font-size:16px;
cursor:pointer;
}

.buy-now{
flex:1;
padding:14px;
background:#1035d6;
border:none;
color:white;
border-radius:8px;
font-size:16px;
cursor:pointer;
}

.stock{
margin-top:10px;
color:#777;
}

.btnHome{
margin-bottom:20px;padding:10px 15px;background:#eee;border:none;border-radius:8px;cursor:pointer;
background-color: #1035d6;
color: white;
}

.btnHome:hover{
background-color: #2563eb;}

</style>
</head>


<body>

<div class="header">

<div class="logo">
FASHION STORE
</div>

<div class="nav">
<a href="/home">Trang chủ</a>
<a href="/products">Sản phẩm</a>
<a href="/cart">Giỏ hàng</a>
<a href="/login">Đăng nhập</a>
</div>

</div>


<div class="container">

<button onclick="window.location.href='/home'" class="btnHome">
← Quay lại danh sách sản phẩm
</button>


<div class="product">

<div class="product-image">
<img src="{{ $product->image }}">
</div>


<div class="product-info">

<div class="category">
{{ $product->category->name ?? 'Thời trang' }}
</div>

<h1>
{{ $product->name }}
</h1>

<div class="price">
{{ number_format($product->price) }}đ
</div>

<div class="description">
{{ $product->description }}
</div>


<div class="option-title">
Màu sắc
</div>

<div class="options">
<button>Trắng</button>
<button>Đen</button>
<button>Xám</button>
<button>Xanh Navy</button>
</div>


<div class="option-title">
Kích thước
</div>

<div class="options">
<button>S</button>
<button>M</button>
<button>L</button>
<button>XL</button>
<button>XXL</button>
</div>


<div class="option-title">
Số lượng
</div>

<div class="quantity">

<button onclick="minus()">-</button>

<input type="text" id="qty" value="1">

<button onclick="plus()">+</button>

</div>


<div class="actions">

<button class="add-cart">
<i class="fas fa-shopping-cart" title="Giỏ hàng"></i>
 Thêm vào giỏ hàng
</button>

<button class="buy-now">
Mua ngay
</button>

</div>

<div class="stock">
Còn {{ $product->stock }} sản phẩm trong kho
</div>


</div>

</div>

</div>


<script>

function plus(){
let qty=document.getElementById("qty");
qty.value=parseInt(qty.value)+1;
}

function minus(){
let qty=document.getElementById("qty");
if(qty.value>1){
qty.value=parseInt(qty.value)-1;
}
}

</script>


</body>
</html>