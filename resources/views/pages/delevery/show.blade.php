@extends('layouts.master')

@section('title')
  <title>Product</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Delivery
        <small>View All Delivery</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/delevery">Delivery</a></li>
        <li class="active">All Delivery</li>
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

              <h3 class="box-title">Delivery Table</h3>

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
                      <th width="55px">Date</th>
                      <th>Ref</th>
                      <th>D Ref</th>
                      <th>Name</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Driver</th>
                      <th>Destination</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($deleveries as $del)
                      <tr>
                        <td>{{ $del['date'] }}</td>
                        <td>{{ $del['ref'] }}</td>
                        <td>{{ $del['d_ref'] }}</td>
                        <td>{{ $del->sellsRel['name']. ' - '. $del->sellsRel['address'] }}</td>
                        <td>{{ \App\Model\Products::find($del->sellsRel['product_id'])['name'] }}</td>
                        <td>{{ $del['quantity']. ' '. \App\Model\Products::find($del->sellsRel['product_id'])['unit'] }}</td>
                        <td>{{ $del['driver'] }}</td>
                        <td>{{ $del['destination'] }}</td>
                        <td>Update</td>
                      </tr>
                    @endforeach
                    
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