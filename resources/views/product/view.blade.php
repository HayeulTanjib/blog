@extends('layouts\app')


@section('content')


<div class="container">
	<div class="row">



		<div class="col-9">
			<div class="card">
				<div class="card-header bg-info">
					<strong>Products List</strong>
				</div>
				<div class="card-body">

					@if(session('deletestatus'))

					<div class="alert alert-danger">
						{{ session('deletestatus') }}

					</div>

					@endif

					<table class="table table-bordered">
						<tr>
							<th>SL No.</th>
							<th>Product Name</th>
							<th>Category Name</th>
							<th>Product Description</th>
							<th>Product Price</th>
							<th>Product Quentity</th>
							<th>Product Alert Quentity</th>
							<th>Product Image</th>
							<th>Action</th>
						</tr>

						@forelse($products as $product => $value)

						<tr>
							<td>{{ $product+$products->firstItem() }}</td>

							<td>{{ $value->product_name }}</td>
							<td>{{ $value->relationToCategory->category_name }}</td>
							<td>{{ str_limit($value->product_description,30) }}</td>
							<td>{{ $value->product_price }}</td>
							<td>{{ $value->product_quantity }}</td>
							<td>{{ $value->product_alert }}</td>

							<td>
							<img src="{{asset('uploads/product_photos')}}/{{$value->product_image}}" alt="not found" width="50">
							</td>

							<td>
								<div class="btn-group">
									<a href="{{url('delete\product')}}\{{$value->id}}" class="btn btn-sm btn-danger">Delete</a>

									<a href="{{ url('edit\product')}}\{{$value->id}}" class="btn btn-sm btn-primary">Edit</a>
								</div>
							</td>
						</tr>

						@empty

						<tr class="alert alert-danger text-center">
							<td colspan="9">No Data Available!</td>
						</tr>

						@endforelse

					</table>  

					{{$products->appends(['p1' => $products->currentPage(), 'p2' => $deletedProducts->currentPage()])->links()}}


					{{-- {{ $products->links() }} --}}

				</div>
			</div>
			

			{{-- DELETE TABLE START --}}

			
			<div class="card mt-5">
				<div class="card-header bg-danger">
					<strong>Deleted List</strong>
				</div>
				<div class="card-body">

					@if(session('forcedeletestatus'))
					<div class="alert alert-danger">
						{{session('forcedeletestatus')}}
					</div>
					@elseif(session('restorestatus'))
						<div class="alert alert-success">
						{{session('restorestatus')}}
					</div>
					@endif

					<table class="table table-bordered">
						
						<tr>
							<th>SL No.</th>
							<th>Product Name</th>
							<th>Product Description</th>
							<th>Product Price</th>
							<th>Product Quentity</th>
							<th>Product Alert Quentity</th>
							<th>Action</th>
						</tr>

						<tr>

							@forelse($deletedProducts as $product => $value)

							<td>{{$product+$deletedProducts->firstItem()}}</td>
							<td>{{$value->product_name}}</td>
							<td>{{str_limit($value->product_description,30)}}</td>
							<td>{{$value->product_price}}</td>
							<td>{{$value->product_quantity}}</td>
							<td>{{$value->product_alert}}</td>
							<td>
								<div class="btn-group">
									<a href="{{url('restore/product')}}/{{$value->id}}" class="btn btn-sm btn-info">Restore</a>

									<a href="{{url('forcedelete/product')}}/{{$value->id}}" class="btn btn-sm btn-danger">Force delete</a>
								</div>
							</td>
						</tr>
						@empty
						<tr class="text-danger text-center">
							<td colspan="9">No Data Available!</td>
						</tr>
						@endforelse
						
					</table>  

					{{$deletedProducts->appends(['p1' => $products->currentPage(), 'p2' => $deletedProducts->currentPage()])->links()}}


					{{-- {{$deletedProducts->links()}} --}}

				</div>
			</div>
		</div>



		{{-- ADD PRODUCT FROM --}}


		<div class="col-3">
			<div class="card">
				<div class="card-header bg-info">
					<strong>Add Product</strong>
				</div>
				<div class="card-body">


					@if(session('status'))

					<div class="alert alert-success">
						{{ session('status') }}
					</div>

					@endif


					{{-- Error alert message --}}

					@if($errors->all())
					<div class="alert alert-danger">

						@foreach($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

					<form action="{{ url('add/product/insert') }}" method="POST" enctype="multipart/form-data">

						@csrf

                         
                         <div class="form-group">
                         	<label for="name">Category Name</label>
                         	<select name="category_id" class="form-control">
                         		<option value="">Select Category</option>
                                
                                @foreach($categories as $category)

                         		<option value="{{$category->id}}">{{$category->category_name}}</option>

                         		@endforeach

                         	</select>
                         </div>

						<div class="form-group">
							<label for="name">Product Name</label>
							<input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" value="{{old('product_name')}}">
						</div>


						<div class="form-group">
							<label for="name">Product Description</label>
							<textarea class="form-control" name="product_description" rows="3">{{old('product_description')}}</textarea>
						</div>


						<div class="form-group">
							<label for="name">Product Price</label>
							<input type="text" name="product_price" class="form-control" placeholder="Enter Product Price" value="{{old('product_price')}}">
						</div>

						<div class="form-group">
							<label for="name">Product Quentity</label>
							<input type="text" name="product_quantity" class="form-control" placeholder="Enter Product Quentity" value="{{old('product_quantity')}}">
						</div>


						<div class="form-group">
							<label for="name">Product Alert Quentity</label>
							<input type="text" name="product_alert" class="form-control" placeholder="Enter Product Alert Quentity" value="{{old('product_alert')}}">
						</div>

						<div class="form-group">
							<label for="name">Product Image</label>
							<input type="file" class="form-control" name="product_image">
						</div>


						<button type="submit" name="add_btn" class="btn btn-outline-primary">Add Product</button>

					</form>


				</div>
			</div>
		</div>
	</div>
</div>

@endsection


