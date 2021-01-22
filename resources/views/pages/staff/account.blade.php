@extends('layouts.master')

@section('title')
  <title>Staff Account</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Staff
        <small>View Staff Account</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/staff">Staff</a></li>
        <li class="active"><a href="/staff/account/2">Staff Name</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <section class="col-lg-6 connectedSortable">
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Staff Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="panel panel-success">
                  <div class="panel-heading">
                      <b>Staff Details</b>
                  </div>

                  <div class="panel-body">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label for="name" class="col-xs-3">Name</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span><b>{{ 'Hurmus Ali' }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Address</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span><b>{{ 'BonPara' }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Designation</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span><b>{{ 'Night Guard' }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Phone</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span><b>{{ '0193849374' }}</b></span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </section>



        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Account Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="panel panel-warning" style="position: relative;">
                  <div class="overlay" id="ad_overlay"><img src="images/spinner.gif"></div>
                  <div class="panel-heading">
                      <b>Account details</b>
                  </div>

                  <div class="panel-body">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label for="name" class="col-xs-3">Working Month</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span><b id="ad_month"></b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Total Selery</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span><b id="ad_selery"></b></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-xs-3 text-danger">Paid</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span class="text-danger"><b id="ad_paid"></b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3 text-success">Balance</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-8">
                                <span class="text-success"><b id="ad_balance"></b></span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>


        </section>



        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Monthly Selery Details</h3>

              <div class="box-tools pull-right">
                <button 
                class="btn btn-info btn-sm" 
                data-toggle="modal" 
                data-target="#staffAddSeleryModal"
                data-name="{{ 'Hurmus Ali' }}"
                data-selery="{{ 9000 }}"
                data-staffid="{{ 2 }}"
                id="addSeleryBtn"
                ><b>Add Selery</b></button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="table-responsive">
                  <table id="selery_table" class="table table-border table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i = 1; $i < 16; $i++)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('d-m-Y') }}</td>
                          <td>{{ random_int(01, 12) }}</td>
                          <td>{{ random_int(6000, 15000) }}</td>
                          <td>{{ 'Update' }}</td>
                        </tr>

                      @endfor
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="3">Total</th>
                        <th colspan="2">{{ 12000 }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>


        </section>


        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Paid Selery Details</h3>

              <div class="box-tools pull-right">
                <button 
                class="btn btn-danger btn-sm" 
                id="paySelery"
                data-toggle="modal"
                data-target="#staffPaySeleryModal"
                data-name="{{ 'Hurmus Ali' }}"
                data-staffid="{{ 2 }}"
                ><b>Pay Selery</b></button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="table-responsive">
                  <table id="payment_table" class="table table-border table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i = 1; $i < 16; $i++)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('d-m-Y') }}</td>
                          <td>{{ random_int(6000, 15000) }}</td>
                          <td>{{ 'Update' }}</td>
                        </tr>
                      @endfor
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2">Total</th>
                        <th colspan="2">{{ 12000 }}</th>
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