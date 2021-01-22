@extends('layouts.master')

@section('title')
  <title>Staffs Payment</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Staff Payment
        <small>View Staff Payments</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/staff">Staff</a></li>
        <li class="active">Payments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Given selery</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="row">
                  <div class="input-daterange">
                    <div class="col-md-4">
                      <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_pay" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <input type="text" placeholder="End Date" autocomplete="off" id="end_date_pay" class="form-control">
                    </div>

                    <div class="col-md-4">
                      <button class="btn btn-primary btn-block" id="search_date_pay">Search</button>
                    </div>
                  </div>
                </div>
                <br>
              <div class="table-responsive">
              <table id="tblPayment" class="table table-responsive table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>name</th>
                  <th>Amount</th>
                  <th>Author</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @for ($i = 0; $i < 10; $i++)
                    <tr>
                      <td>{{ date('d-m-Y') }}</td>
                      <td>{{ str_shuffle('A.B. Siddik') }}</td>
                      <td>{{ random_int(1000, 9000) }}</td>
                      <td>{{ str_shuffle('A.B. Siddik') }}</td>
                      <td>Update</td>
                    </tr>
                  @endfor
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="2">Page</th>
                    <th colspan="3" id="p_total">123</th>
                  </tr>

                  <tr>
                    <th colspan="2">Total</th>
                    <th colspan="3" id="total">123</th>
                  </tr>
                </tfoot>
            </table>
            </div>

            </div>


        </section>


        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-light-blue-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Staff Montly Selery</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-light-blue btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-light-blue btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="row">
                  <div class="input-daterange">
                    <div class="col-md-4">
                      <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_selery" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <input type="text" placeholder="End Date" autocomplete="off" id="end_date_selery" class="form-control">
                    </div>

                    <div class="col-md-4">
                      <button class="btn btn-primary btn-block" id="search_date_selery">Search</button>
                    </div>
                  </div>
                </div>
                <br>
              <div class="table-responsive">
              <table id="tblSelery" class="table table-responsive table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Author</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @for ($i = 0; $i < 15; $i++)
                    <tr>
                      <td>{{ date('d-m-Y') }}</td>
                      <td>{{ str_shuffle('AB Siddik') }}</td>
                      <td>{{ random_int(01, 12) }}</td>
                      <td>{{ random_int(6000, 15000) }}</td>
                      <td>{{ Auth::user()->name }}</td>
                      <td>Update</td>
                    </tr>
                  @endfor
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3">Page</th>
                    <th colspan="3" id="p_total"></th>
                  </tr>

                  <tr>
                    <th colspan="3">Total</th>
                    <th colspan="3" id="total"></th>
                  </tr>
                </tfoot>
            </table>
            </div>

            </div>



        </section>

      </div>
      <!-- /.row (main row) -->
    </section>

@endsection