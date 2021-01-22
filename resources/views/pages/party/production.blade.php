@extends('layouts.master')

@section('title')
  <title>Party production</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Party Production
        <small>View Party Production</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/party">Party</a></li>
        <li>Production</li>
        <li class="active">{{ str_shuffle('Party Name') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <style>
      .overlay{
        display: none;
      }
    </style>
    
    <section class="content">

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Production Today </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
              <table id="production_list_today" class="table table-responsive table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                      @for ($i = 1; $i < 16; $i++)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('d-m-Y') }}</td>
                          <td>{{ str_shuffle("akdjfkdj") }}</td>
                          <td>{{ str_shuffle("akdjfkdj") }}</td>
                          <td>{{ random_int(1000, 5000) }}</td>
                          <td>Update</td>
                        </tr>
                      @endfor
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4">total</th>
                    <th colspan="2">{{ random_int(9000, 90000) }}</th>
                  </tr>
                </tfoot>
            </table>
            </div>
            </div>
        </section>


        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title"> {{ 'Production This Week '.date("d-m-Y"). ' / '.date("d-m-Y") }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
              <table id="production_list_this_week" class="table table-responsive table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                      @for ($i = 1; $i < 16; $i++)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('d-m-Y') }}</td>
                          <td>{{ str_shuffle('skdfksdjhfk') }}</td>
                          <td>{{ str_shuffle('skdfksdjhfk') }}</td>
                          <td>{{ random_int(1000, 9000) }}</td>
                          <td>{{ 'Update' }}</td>
                        </tr>
                      @endfor
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4">total</th>
                    <th colspan="2">123</th>
                  </tr>
                </tfoot>
            </table>
            </div>
            </div>
        </section>


        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">All Productions</h3>

              <div class="box-tools pull-right">
                <button class="btn bg-red btn-sm" id="reload_all_production"><i class="fa fa-refresh"></i></button>
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
                    <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_all" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="End Date" autocomplete="off" id="end_date_all" class="form-control">
                  </div>

                  <div class="col-md-4">
                    <button class="btn btn-primary btn-block" id="search_date_all">Search</button>
                  </div>
                </div>
              </div>
              <br>
              <div class="table-responsive">
              <table id="production_list_all" class="table table-responsive table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>date</th>
                  <th>name</th>
                  <th>description</th>
                  <th>quantity</th>
                  <th>action</th>
                </tr>
                </thead>

                <tbody>
                  @for ($i = 1; $i < 16; $i++)
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ date('d-m-Y') }}</td>
                        <td>{{ str_shuffle("akdjfkdj") }}</td>
                        <td>{{ str_shuffle("akdjfkdj") }}</td>
                        <td>{{ random_int(1000, 5000) }}</td>
                        <td>Update</td>
                      </tr>
                    @endfor
                </tbody>
                
               <tfoot>
                  <tr>
                    <th colspan="4">Page</th>
                    <th colspan="2" id="p_total">123</th>
                  </tr>
                  <tr>
                    <th colspan="4">Total</th>
                    <th colspan="2" id="total">123</th>
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