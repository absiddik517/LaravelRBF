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
        <section class="col-lg-6">
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
              <div class="table-responsive">
                <table id="ruleTable" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Rule</th>
                      <th>Insert</th>
                      <th>Update</th>
                      <th>Delete</th>
                      <th>Users</th>
                      <th>Rule Add</th>
                      <th>Permission</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                      function permission($value)
                      {
                        $new = '';
                        switch ($value) {
                          case '0':
                            $new = "x";
                            break;

                          case '1':
                            $new = "*";
                            break;

                          case '':
                            $new = "x";
                            break;
                        }
                        return $new;
                      }
                    @endphp
                   	@foreach ($rules as $rule)
                    @php
                      $per = $rule['PermissionRel'];
                    @endphp
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $rule['name'] }}</td>
                        <td>{{ permission($per['insert_access']) }}</td>
                        <td>{{ permission($per['update_access']) }}</td>
                        <td>{{ permission($per['delete_access']) }}</td>
                        <td>{{ permission($per['user_access']) }}</td>
                        <td>{{ permission($per['rule_access']) }}</td>
                        <td>{{ permission($per['permission_access']) }}</td>
                      </tr>
                    @php
                      $i++;
                    @endphp
                    @endforeach
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
				    <select name="rule_id" id="rule_id" class="form-control">
              <option value="">Select one</option>  
              @foreach ($rules as $rule)
                <option value="{{ $rule['id'] }}">{{ $rule['name'] }}</option>
              @endforeach  
            </select>
				  </div>

          <div class="form-group">
            <label for="name">Insert Access</label>
            <select name="insert_access" id="insert_access" class="form-control">
              <option value="">Select one</option>  
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Update Access</label>
            <select name="update_access" id="update_access" class="form-control">
              <option value="">Select one</option>  
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Delete Access</label>
            <select name="delete_access" id="delete_access" class="form-control">
              <option value="">Select one</option>  
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">User Access</label>
            <select name="user_access" id="user_access" class="form-control">
              <option value="">Select one</option>  
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Rule Access</label>
            <select name="rule_access" id="rule_access" class="form-control">
              <option value="">Select one</option>  
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Permission Access</label>
            <select name="permission_access" id="permission_access" class="form-control">
              <option value="">Select one</option>  
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
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
  	
  </script>
@endsection

 {{-- {
  "id"          : 4,
  "name"        : "Admin",
  "created_at"  : "2020-09-04T09:06:05.000000Z",
  "updated_at"  : "2020-09-04T09:34:00.000000Z",
  "permission_rel":{
          "id"        : 1,
          "rule_id"   : 4,
          "insert_access" : 1,
          "update_access" : 1,
          "delete_access" : 1,
          "rule_access" : 1,
          "permission_access" : 0,
          "user_access" : 0,
          "created_at" : null,
          "updated_at":null
          }
} --}}