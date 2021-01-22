@extends('layouts.master')

@section('title')
  <title>Rules</title>
@endsection


@section('body')
  
<section class="content-header">
  <h1>
    Permission
    <small>Allow Permission In Rule</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#">Rules</a></li>
  </ol>
</section>

<section class="content">
	<div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Rules</h3>

              <div class="box-tools pull-right">
                <a href="{{ route('rules') }}" class="btn btn-danger">Rules</a>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
            	<div class="box-body">
            		
	            	<form action="" class="form-horizontal">
	            		<div class="form-group">
	            			<label for="name">Name</label>
	            			<input type="text" class="form-control" id="name">
	            			<span style="color: red; font-weight: bold;" id="name_error"></span>
	            		</div>

	            		<div class="form-group">
	            			<label for="address">Address</label>
	            			<input type="text" class="form-control" id="address">
	            			<span style="color: red; font-weight: bold;" id="address_error"></span>
	            		</div>

	            		<div class="form-group">
	            			<label for="Phone">Phone</label>
	            			<input type="text" class="form-control" id="Phone">
	            			<span style="color: red; font-weight: bold;" id="phone_error"></span>
	            		</div>

	            		<div class="form-group">
	            			<button class="btn btn-primary btn-sm" id="sendReq">Send Request</button>
	            		</div>
	            	</form>
	            </div>
           </div>
        </section>
      </div>
    </section>



@endsection

@section('script')
  <script>
  	$(document).ready(function() {
  		$('#sendReq').click(function(e) {
  			e.preventDefault();
  			let token = $('meta[name="csrf-token"]').attr('content');
  			let data = {
  				name : $('#name').val(),
  				address : $('#address').val(),
  				phone : $('#Phone').val(),
  				_token : token
  			};

  			$.ajax({
  				url : '/ajax/process',
  				method : 'POST',
  				dataType : "JSON", 
  				data : data,
  				beforeSend: function() {
  					console.log('Sending request');
  				},
  				success: function(res) {
  					console.log('response received');
  					console.log(res);

  					if(res.validation_failed == 1){
	  					let error = res.errors;
	  					$('#name_error').text(error.name);
	  					$('#address_error').text(error.address);
	  					$('#phone_error').text(error.phone);
  					}else{
  						$('#name_error').text('');
	  					$('#address_error').text('');
	  					$('#phone_error').text('');
	  					Swal(res.t, res.m, res.s);
  					}
  				},
  				error: function(errors) {
  					// console.log(errors);
  				}
  			});
  		});
  	})
  </script>
@endsection
