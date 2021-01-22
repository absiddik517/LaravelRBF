@extends('layouts.master')

@section('title')
  <title>Rules</title>
@endsection


@section('body')
  
<section class="content-header">
  <h1>
    Rules
    <small>Users Rules</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#">Rules</a></li>
  </ol>
</section>

<section class="content">
	<div class="row">
        <!-- Left col -->
        <section class="col-lg-6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Rules</h3>

              <div class="box-tools pull-right">
              	<a href="{{ route('permission') }}" class="btn btn-danger">Permissions</a>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
                <table id="ruleTable" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   	@foreach ($rules as $data)
                      <tr>
                        <td>{{ $data['id'] }}</td>
                        <td width="60%">{{ $data['name'] }}</td>
                        <td>
                        	<button data-id="{{ $data['id'] }}" data-name="{{ $data['name'] }}" class="btnEdit btn btn-primary">Edit <i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                    @endforeach

                    @if (count($rules) == 0)
                    	<tr>
                    		<td colspan="3" style="text-align: center;">No data in table</td>
                    	</tr>
                    @endif
                    
                  </tbody>
                </table>
              </div>

            </div>
        </section>


        <section class="col-lg-6">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Add New Rules</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              @if (count($errors->all()) > 0)
              	<div class="alert alert-danger">
              		<ul>
	              		@foreach ($errors->all() as $error)
	              			<li>{{ $error }}</li>
	              		@endforeach
              		</ul>
              	</div>
              @endif
              <form action="" method="post">
              	@csrf
				  <div class="form-group">
				    <label for="name">Rule Name</label>
				    <input type="text" class="form-control has-error" id="name" name="name" aria-describedby="nameHelp">
				    <small id="nameHelp" class="form-text text-muted">Rule name should be unique.</small>
				  </div>

				  <button type="submit" class="btn btn-primary">Submit</button>
				    
				</form>

            </div>
        </section>

    </div>

</section>


<div id="editModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
      	<!-- modal content -->
      	<div class="modal-content">
      		<div class="modal-header">
      			<button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
      			<h4 class="modal-title">Update Rule</h4>
      		</div>
      		<form action="" method="post">
      		<div class="modal-body">
      				@csrf
      				@method('PUT')
      				<input type="hidden" id="edit_id" name="id">
      				<div class="form-group">
				    <label for="name">Rule Name</label>
				    <input type="text" class="form-control has-error" id="name_edit" name="name" aria-describedby="nameHelp">
				    <small id="nameHelp" class="form-text text-muted">Rule name should be unique.</small>
				  </div>

      		</div>
      		<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
      			<button class="btn btn-danger" data-dismiss="modal">Close</button>
      		</div>
      		</form>
      	</div>
      </div>
</div>

@endsection

@section('script')
  <script>
  	$(document).ready(function() {
  		$('#ruleTable').on('click', '.btnEdit', function(e) {
  			e.preventDefault();
  			let obj = {};
  			obj.id = $(this).data('id');
  			obj.name = $(this).data('name');

  			$('#name_edit').val(obj.name);
  			$('#edit_id').val(obj.id);
  			$('#editModal').modal('show');
  		})
  	});
  </script>
@endsection

