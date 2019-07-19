@extends('layouts\app')


@section('content')

<div class="container">
	<div class="row">
		


<div class="col-7">
	<div class="card">
		<div class="card-header">
			<strong>Category List</strong>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<th>SL NO.</th>
					<th>Category Name</th>
					<th>Menu Status</th>
					<th>Created At</th>
					<th>Action</th>
				</tr>

@foreach($categories as $category)

				<tr>
					<td>{{$loop->index+1}}</td>
					<td>{{$category->category_name}}</td>
					<td>{{ ($category->menu_status == 1) ? 'YES':'NO' }}</td>
					<td>
						{{ $category->created_at->format('d:m:Y | h:i:s A') }} <br>

                        {{ $category->created_at->diffForHumans() }}
					</td>
					<td>
						<a href="{{url('change/menu/status')}}/{{$category->id}}" class="btn btn-sm btn-info">Change</a>
					</td>
				</tr>
@endforeach
			</table>
		</div>
	</div>
</div>



<div class="col-5">
	<div class="card">
		<div class="card-header">
			<strong>Add Menu</strong>
		</div>
		<div class="card-body">

@if($errors->all())
@foreach($errors->all() as $error)
<div class="alert alert-danger">
	<li>{{$error}}</li>
</div>
@endforeach
@endif			

			<form action="{{url('category/product/insert')}}" method="POST">

            @csrf

				<div class="form-group">
					<label for="name">Category Name</label>
					<input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{old('category_name')}}"> <br>
					
					<div class="form-group">
					<input type="checkbox" name="menu_status" id="menu"> <label for="menu">Set as Menu</label>
					</div>

					<button type="submit" name="btn" class="btn btn-outline-primary">Add Category</button>
				</div>
			</form>

		</div>
	</div>
</div>


	</div>
</div>


@endsection