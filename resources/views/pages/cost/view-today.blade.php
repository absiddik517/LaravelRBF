@extends('layouts.master')

@section('title')
  <title>View Cost Today</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Cost
        <small>View Cost Today</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/cost">Cost</a></li>
        <li class="active">Cost Today</li>
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
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Cost Table</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
                <div class="row">
                  <div class="input-daterange">
                    <div class="col-md-4">
                      <input type="text" name="start_date" placeholder="Start Date" autocomplete="off" id="start_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <input type="text" name="end_date" placeholder="End Date" autocomplete="off" id="end_date" class="form-control">
                    </div>

                    <div class="col-md-4">
                      <button class="btn btn-primary" id="search_date">Search</button>
                    </div>
                  </div>
                </div>
                <br>
                <table id="sellToday" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Ref</th>
                      <th width="55px">Date</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Product</th>
                      <th>Rate</th>
                      <th>Quantity</th>
                      <th>Total</th>
                      <th>Due Pay</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @for ($i = 0; $i < 30; $i++)
                      <tr>
                        <td>123</td>
                        <td>22/09/2020</td>
                        <td>Shipon</td>
                        <td>Barurjani</td>
                        <td>7.6</td>
                        <td>1000</td>
                        <td>7600</td>
                        <td>5600</td>
                        <td>1000</td>
                        <td>1000</td>
                        <td>Update</td>
                      </tr>
                    @endfor
                    
                  </tbody>
                </table>
              </div>

            </div>
        </section>


        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Monthly Sells Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <canvas id="sellsChart"></canvas>

            </div>
        </section>

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Monthly Income Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                
              <!-- chart will goes here -->
              <canvas id="incomeChart"></canvas>

            </div>
        </section>

      </div>
      <!-- /.row (main row) -->
    </section>

@endsection