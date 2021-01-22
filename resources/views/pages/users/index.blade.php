@extends('layouts.master')

@section('title')
  <title>Users</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Users
        <small>View All Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Users</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      @if (count($errors->all()) > 0)
        <div class="row">
          <section class="col-lg-4 col-lg-offset-4">
            <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
              </ul>
            </div>
          </section>
        </div>  
      @endif

      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Users List</h3>

              <div class="box-tools pull-right">
                <button type="button" data-toggle="modal" data-target="#addStaffModal" class="btn bg-teal">Add Users
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
                <table id="UsersTable" class="table table-bordered table-hover table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Rule</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['UserRule']['name'] }}</td>
                        <td>
                          <button class="btn-edit btn btn-info" data-id="{{ $user['id'] }}" data-name="{{ $user['name'] }}" data-email="{{ $user['email'] }}" data-phone="{{ $user['phone'] }}" data-roleid="{{ $user['UserRule']['id'] }}">Update <i class="fa fa-edit"></i></button>
                        </td>
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

      </div>
      <!-- /.row (main row) -->
    </section>

    <div id="editModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update User</h4>
          </div>
          <form action="" method="post">
          <div class="modal-body">
              @csrf
              @method('PUT')
              <input type="hidden" id="edit_id" name="id">
              <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" id="name_edit" name="name">
              </div>

              <div class="form-group">
                <label for="email_edit">Email</label>
                <input type="email" class="form-control" id="email_edit" name="email">
              </div>

              <div class="form-group">
                <label for="phone_edit">Phone</label>
                <input type="text" class="form-control" id="phone_edit" name="phone">
              </div>
              
              <div class="form-group">
                <label for="user_rule">Rule</label>
                <select class="form-control" id="user_rule" name="rule_id">
                  <option value="">Select One</option>
                  @foreach (App\Model\RulesModel::all() as $rule)
                    <option value="{{ $rule['id'] }}">{{ $rule['name'] }}</option>
                  @endforeach
                </select>
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
      $('#UsersTable').on('click', '.btn-edit', function() {
        $('#name_edit').val($(this).data('name'));
        $('#email_edit').val($(this).data('email'));
        $('#phone_edit').val($(this).data('phone'));
        $('#user_rule').val($(this).data('roleid'));
        $('#edit_id').val($(this).data('id'));
        $('#editModal').modal('show');
      });
    })
  </script>

@endsection