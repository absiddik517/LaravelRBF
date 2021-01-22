@extends('layout.master')

@section('title')
  <title>Product</title>
@endsection


@section('body')
	<section class="content">
		@if(isset($Message))
			<div class="container">
				<div class="container">
					<div class="alert alert-success">
						{{ $Message }}
					</div>
				</div>
			</div>
		@endif
		<div class="panel panel-success">
			<div class="panel-heading">
				Insert Data into database
			</div>

			<div class="panel-body">
				<div class="title">
					Fill out all fields
				</div>

				<div class="content">
					<div class="container">
					<form action="{{ view('pages.product.insert2') }}" method="POST" class="form-horizontal">
							<div class="form-group">
								<div class="col-md-2">
									<label for="Catagory">Catagory</label>
								</div>
								<div class="col-md-10">
									<input type="text" name="Catagory" id="Catagory" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-2">
									<label for="Brand">Brand</label>
								</div>
								<div class="col-md-10">
									<input type="text" name="Brand" id="Brand" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-2">
									<label for="Description">Description</label>
								</div>
								<div class="col-md-10">
									<input type="text" name="Description" id="Description" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-2">
									<label for="Price">Price</label>
								</div>
								<div class="col-md-10">
									<input type="text" name="Price" id="Price" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<button class="btn btn-primary pull-right" id="Submit">Submit</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection