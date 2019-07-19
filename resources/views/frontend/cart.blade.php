@extends('layouts/frontendapp')

@section('frontend_content')


<!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="{{url('/')}}">Home</a> / 
				<a href="">Sales</a> / 
				<a href="">Bags</a> / 
				<span>Cart</span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
			<div class="cart-table">
				<table>
					<thead>
						<tr>
							<th class="product-th">Product</th>
							<th>Price</th>
							<th>Quantity</th>
							<th class="total-th">Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cartIteams as $cartIteam)
						<tr>
							<td class="product-col">
								<img src="{{asset('uploads/product_photos')}}/{{$cartIteam->relationToProduct->product_image}}" width="100" alt="not found">
								<div class="pc-title">
							{{-- <h4>{{ App\Product::find($cartIteam->product_id)->product_name }}</h4> --}}

							<h4>{{ $cartIteam->relationToProduct->product_name }}</h4>

									<a href="{{'delete/from/cart'}}/{{$cartIteam->product_id}}">Delete Product</a>

									@if($cartIteam->relationToProduct->product_quantity == 0)
									<div class="text-danger">
									Delete this ! Out off stock !!
									</div>
									@endif
								</div>
							</td>
							<td class="price-col">${{ $cartIteam->relationToProduct->product_price }}</td>
							<td class="quy-col">
								<div class="quy-input">
									<span>Qty</span>
									<input type="number" value="{{$cartIteam->product_quantity}}">
								</div>
							</td>
				<td class="total-col">${{($cartIteam->relationToProduct->product_price)*($cartIteam->product_quantity)}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="row cart-buttons">
				<div class="col-lg-5 col-md-5">
					<a href="{{url('/')}}"><div class="site-btn btn-continue">Continue shooping</div></a>
				</div>
				<div class="col-lg-7 col-md-7 text-lg-right text-left">
					<a href="{{url('clear/cart')}}"><div class="site-btn btn-clear">Clear cart</div></a>
					<div class="site-btn btn-line btn-update">Update Cart</div>
				</div>
			</div>
		</div>
		<div class="card-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="shipping-info">
							<h4>Shipping method</h4>
							<p>Select the one you want</p>
							<div class="shipping-chooes">
								<div class="sc-item">
									<input type="radio" name="sc" id="one">
									<label for="one">Next day delivery<span>$4.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="two">
									<label for="two">Standard delivery<span>$1.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="three">
									<label for="three">Personal Pickup<span>Free</span></label>
								</div>
							</div>
							<h4>Cupon code</h4>
							<p>Enter your cupone code</p>
							<div class="cupon-input">
								<input type="text">
								<button class="site-btn">Apply</button>
							</div>
						</div>
					</div>
					<div class="offset-lg-2 col-lg-6">
						<div class="cart-total-details">
							<h4>Cart total</h4>
							<p>Final Info</p>
							<ul class="cart-total-card">

								<li>Subtotal<span>$111</span></li>
								<li>Shipping<span>Free</span></li>

								<li class="total">Total<span>$59.90</span></li>
							</ul>
							<a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page end -->





@endsection