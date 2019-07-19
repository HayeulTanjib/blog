@extends('layouts/app')


@section('content')

<div class="container">
	<div class="row">

		<div class="col-6 offset-3">

<nav aria-lebel='breadcrumb'>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
	<li class="breadcrumb-item"><a href="{{url('/add/product/view')}}">Add Product</a></li>
	<li class="breadcrumb-item active" aria-current='page'>{{ $products_info->product_name }}</li>
</ol>
</nav>



		

<div class="card">
				<div class="card-header bg-info">
					<strong>Edit Product</strong>
				</div>
				<div class="card-body">

@if($errors->all())
					@foreach($errors->all() as $error)

					<div class="alert alert-danger">
						<li>{{$error}}</li>
					</div>

					@endforeach
@endif

					<form action="{{ url('delete/product/insert') }}" method="POST" enctype="multipart/form-data">

						@csrf

						@if(session('updatestatus'))

						<div class="alert alert-success">
							{{ session('updatestatus') }}
						</div>

						@endif

						<div class="form-group">
							<label for="name">Product Name</label>
							<input type="hidden" name="product_id" value="{{ $products_info->id }}">
							<input type="text" name="product_name" class="form-control" value="{{ $products_info->product_name }}">
						</div>


						<div class="form-group">
							<label for="name">Product Description</label>
							<textarea class="form-control" name="product_description" rows="3">{{ $products_info->product_description }}</textarea>
						</div>


						<div class="form-group">
							<label for="name">Product Price</label>
							<input type="text" name="product_price" class="form-control" value="{{ $products_info->product_price }}">
						</div>

						<div class="form-group">
							<label for="name">Product Quentity</label>
							<input type="text" name="product_quantity" class="form-control" value="{{ $products_info->product_quantity }}">
						</div>


						<div class="form-group">
							<label for="name">Product Alert Quentity</label>
							<input type="text" name="product_alert" class="form-control" value="{{ $products_info->product_alert }}">
						</div>

						<div class="form-group">
							<label for="name">Product image</label>
							<input type="file" name="product_image" class="form-control">
						</div>

						<div class="form-group">
							<img src="{{url('uploads/product_photos')}}/{{$products_info->product_image}}" alt="not found" width="100">
						</div>


						<button type="submit" name="add_btn" class="btn btn-outline-primary">Edit Product</button>

					</form>


				</div>
			</div>
		</div>



		</div>

	</div>
</div>

			

@endsection