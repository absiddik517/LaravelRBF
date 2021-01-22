@extends('layouts.master')

@section('title')
<title>Party Account</title>
@endsection


@section('body')
<section class="content-header">
    @php
    $party = PartyHelper::Party($id); //new PartyConfig($id);
    
    @endphp
    <h1>
        Party Account
        <small>View Party Account</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/party">Party</a></li>
        <li><a href="">{{ $party->PartyDetail->name }}</a></li>
        <li class="active">{{ $party->name }}</li>
    </ol>
</section>

<pre id="console"></pre>

<!-- Main content -->
<style>
    .overlay {
        display: none;
    }
</style>
<section class="content">
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box box-solid ">
                <div class="box-header bg-teal-gradient">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Party Details</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body border-radius-none">
                    <div class="panel panel-success" style="position: relative;">
                        <div class="overlay" id="all_detail_overlay">
                            <img src="images/spinner.gif" alt="">
                        </div>
                        <div class="panel-heading">
                            <b>Complete Details</b>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- div for  -->
                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Name
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-8 padding2 dataa" id="party_name"></div>
                                    </div>

                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Address
                                        </div>
                                        <div class="col-xs-1 padding2">:</div>
                                        <div class="col-xs-8 padding2 dataa" id="party_address"></div>
                                    </div>

                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Phone
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-8 padding2 dataa" id="party_phone">
                                        
                                        </div>
                                    </div>

                                    <div class="row borderedd margin3">
                                        <div class="col-xs-2 padding2 labell">
                                            Rate
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-2 padding2 dataa" id="production_rate">
                                            
                                        </div>
                                        <div class="col-xs-4 padding2 labell">
                                            Reduce Rate
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-2 padding2 dataa" id="reduce_rate">
                                            
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Production
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-8 padding2 dataa" id="production">
                                            {{-- $party->production .' | '. $party->_p($party->production, $party->damage_rate, 'm') --}}
                                        </div>
                                    </div>

                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Total Selery
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-8 padding2 dataa" id="total_selery">
                                            
                                        </div>
                                    </div>

                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Total Paid
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-8 padding2 dataa" id="total_paid">
                                        
                                        </div>
                                    </div>

                                    <div class="row borderedd margin3">
                                        <div class="col-xs-3 padding2 labell">
                                            Balance
                                        </div>
                                        <div class="col-xs-1 padding2">
                                            :
                                        </div>
                                        <div class="col-xs-8 padding2 dataa" id="party_balance">
                                    
                                        </div>
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

                        <h3 class="box-title">{{ $party->billing_system }} Details</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-info btn-sm" id="BtnCreateBill">Create Bill</button>
                        </div>
                    </div>

                    <div class="box-body border-radius-none">
                        <div class="panel panel-success" style="position: relative;">
                            <div class="overlay" id="this_week_overlay">
                                <img src="images/spinner.gif" alt="">
                            </div>
                            <div class="panel-heading">
                                <b><span id="start_day"></span><span class="pull-right" id="end_day"></span></b>
                            </div>

                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="row borderedd margin3">
                                            <div class="col-xs-3 padding2 labell">
                                                Production
                                            </div>
                                            <div class="col-xs-1 padding2">
                                                :
                                            </div>
                                            <div class="col-xs-8 padding2 dataa" id="production_this_week">
                                                
                                            </div>
                                        </div>

                                        <div class="row borderedd margin3">
                                            <div class="col-xs-3 padding2 labell">
                                                Total Selery
                                            </div>
                                            <div class="col-xs-1 padding2">
                                                :
                                            </div>
                                            <div class="col-xs-8 padding2 dataa" id="total_selery_this_week">
                                                
                                            </div>
                                        </div>

                                        <div class="row borderedd margin3">
                                            <div class="col-xs-3 padding2 labell">
                                                Total Paid
                                            </div>
                                            <div class="col-xs-1 padding2">
                                                :
                                            </div>
                                            <div class="col-xs-8 padding2 dataa" id="total_paid_this_week">
                                                
                                            </div>
                                        </div>

                                        <div class="row borderedd margin3">
                                            <div class="col-xs-3 padding2 labell">
                                                Balance
                                            </div>
                                            <div class="col-xs-1 padding2">
                                                :
                                            </div>
                                            <div class="col-xs-8 padding2 dataa" id="balance_this_week">
                                                
                                            </div>
                                        </div>
                                        <a class="btn btn-primary btn-sm pull-right" id="print_detail_button">Details</a>
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

                            <h3 class="box-title">Payments</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="box-body border-radius-none">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs bg-aqua">
                                    <li class="active"><a href="#advance" data-toggle="tab">Weekly Advance</a></li>
                                    <li><a href="#preloaded" data-toggle="tab">Adjust Bill</a></li>
                                    <li><a href="#advance_adjust" data-toggle="tab">Advance Cutting</a></li>
                                    <li><a href="#bill" data-toggle="tab">Weekly Bill</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="overlay" id="tab_overlay">
                                        <img src="images/spinner.gif">
                                    </div>

                                    <div class="tab-pane active pr" id="advance">
                                        <div class="disable"></div>
                                        <div class="alert alert-green">
                                            Weekly Advance Panel
                                        </div>
                                        <form class="form-horizontal" id="advance_form">
                                            <div class="description_group form-group">
                                                <label for="advance_description" class="col-md-3">Description</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="description form-control" placeholder="Description" autocomplete="off">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="amount_group form-group">
                                                <label for="advance_amount" class="col-md-3">Amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" data-intype="number" class="amount form-control" placeholder="Amount" autocomplete="off">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <br>


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info pull-right" style="margin-right: 15px;" style="margin-right: 15px;">Submit</button>
                                            </div>

                                        </form>
                                    </div>

                                    <!-- photo upload -->

                                    <div class="tab-pane pr" id="preloaded">
                                        <div class="disable"></div>
                                        <div class="alert alert-red">
                                            Adjust Bill
                                        </div>
                                        <form class="form-horizontal" id="preload_form">
                                            <div class="item_id_group form-group">
                                                <label for="preloaded_item" class="col-md-3">Item</label>
                                                <div class="col-md-7">

                                                    <select id="preloaded_item" class="item_id form-control">
                                                        <option value="">Select One</option>
                                                        @foreach(App\Model\Item::get() as $key)
                                                        <option value="{{ $key['id'] }}">{{ $key['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="invalid-feedback"></span>
                                                </div>

                                                <div class="col-md-1">
                                                    <a href="#" id="btn_add_catagory" class="btn_plus btn"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>


                                            <div class="quantity_group form-group">
                                                <label for="preloaded_qantity" class="col-md-3">Quantity</label>
                                                <div class="col-md-9">
                                                    <input type="text" data-intype="number" id="preloaded_qantity" class="quantity form-control" placeholder="Quantity" autocomplete="off">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="description_group form-group">
                                                <label for="preload_qantity" class="col-md-3">Description (Optional)</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="preload_qantity" class="description form-control" placeholder="Description" autocomplete="off">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="amount_group form-group">
                                                <label for="preloaded_amount" class="col-md-3">Amount</label>
                                                <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" data-intype="number" id="preloaded_amount" class="amount form-control" placeholder="Amount" autocomplete="off">
                                                </div>
                                                </div>
                                                <span class="invalid-feedback"></span>
                                            </div>

                                            <div class="form-group">
                                                <button id="preloaded_submit" class="btn btn-info pull-right" style="margin-right: 15px;">Submit</button>
                                            </div>

                                        </form>
                                    </div>

                                    <!-- change password -->
                                    <div class="tab-pane pr" id="advance_adjust">
                                        <div class="disable"></div>
                                        <div class="alert alert-red">
                                            Advance Cutting
                                        </div>
                                        <form class="form-horizontal" id="advance_cutting_form">
                                            <div class="description_group form-group">
                                                <label for="adjust_description" class="col-md-3">Description</label>
                                                <div class="col-md-9">
                                                    <input value="{{ $party->start .' | '. $party->end }}" type="text" id="adjust_description" class="form-control" placeholder="Description" autocomplete="off" disabled>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="amount_group form-group">
                                                <label for="adjust_amount" class="col-md-3">Amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" data-intype="number" id="adjust_amount" class="amount form-control" placeholder="Amount" autocomplete="off" value="{{ $party->cutting_rate * $party->production }}">
                                                    <div class="help-block" id="adjust_detail"></div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <!--<button type="submit" class="btn btn-info pull-right" style="margin-right: 15px;">Submit</button> -->
                                                <input type="submit" value="Submit" class="btn btn-info pull-right">
                                            </div>

                                        </form>
                                    </div>


                                    <div class="tab-pane pr" id="bill">
                                        <div class="overlay">
                                            <img src="images/spinner.gif" alt="">
                                        </div>
                                        <div class="alert alert-warn">
                                            Weekly Bill Payment
                                        </div>
                                        <form class="form-horizontal" id="bill_form">
                                            <div class="description_group form-group">
                                                <label for="bill_description" class="col-md-3">Description</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="bill_description" class="description form-control" placeholder="Description" autocomplete="off">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="amount_group form-group">
                                                <label for="bill_amount" class="col-md-3">Amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" data-intype="number" id="bill_amount" class="amount form-control" placeholder="Amount" autocomplete="off">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <button id="bill_submit" class="btn btn-info pull-right" style="margin-right: 15px;">Submit</button>
                                            </div>

                                        </form>
                                    </div>

                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </div>


                    </section>



                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="box box-solid ">
                            <div class="box-header bg-teal-gradient">
                                <i class="fa fa-th"></i>

                                <h3 class="box-title">Production</h3>

                                <div class="box-tools pull-right">

                                    <button
                                        class="btn btn-danger btn-sm"
                                        data-id="{{ $id }}"
                                        data-name="{{ $party->name }}"
                                        id="add_party_entry"
                                        >Add Entry</button>
                                    <button class="btn bg-red btn-sm" id="reload_production"><i class="fa fa-refresh"></i></button>
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
                                            <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_production" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="End Date" autocomplete="off" id="end_date_production" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <button class="btn btn-primary btn-block" id="search_date_production">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table id="production_list" class="table table-border table-hover table-striped">
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

                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Page</th>
                                                <th colspan="2" id="p_total">{{ random_int(1000, 12000) }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th colspan="2" id="total">{{ random_int(1000, 12000) }}</th>
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

                                    <h3 class="box-title">Weekly Advance Payments</h3>

                                    <div class="box-tools pull-right">
                                        <button class="btn bg-red btn-sm" id="reload_payments"><i class="fa fa-refresh"></i></button>
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
                                                <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_payments" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" placeholder="End Date" autocomplete="off" id="end_date_payments" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <button class="btn btn-primary btn-block" id="search_date_payments">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <table id="w_adv_list" class="table table-border table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">Page</th>
                                                    <th colspan="2" id="p_total">{{ random_int(1000, 12000) }}</th>
                                                </tr>

                                                <tr>
                                                    <th colspan="4">Total</th>
                                                    <th colspan="2" id="total">{{ random_int(1000, 12000) }}</th>
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

                                        <h3 class="box-title">Adjust Bill</h3>

                                        <div class="box-tools pull-right">
                                            <button class="btn bg-red btn-sm" id="reload_preloaded_list"><i class="fa fa-refresh"></i></button>
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
                                                    <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_preload" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" placeholder="End Date" autocomplete="off" id="end_date_preload" class="form-control">
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" id="search_date_preload">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="table-responsive">
                                            <table id="preloaded_list" class="table table-border table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Name</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Page</th>
                                                        <th>Add to Bill</th>
                                                        <th colspan="2" id="p_addToBill">{{ random_int(1000, 12000) }}</th>
                                                        <th colspan="2">Add to paid</th>
                                                        <th colspan="1" id="p_addToPaid">{{ random_int(1000, 12000) }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Total</th>
                                                        <th>Add to Bill</th>
                                                        <th colspan="2" id="addToBill">{{ random_int(1000, 12000) }}</th>
                                                        <th colspan="2">Add to paid</th>
                                                        <th colspan="1" id="addToPaid">{{ random_int(1000, 12000) }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <style>
                                            .bordered {
                                                border: 1px solid #f4f4f4;
                                                border-radius: 3px;
                                                padding: 6px;
                                                font-weight: bold;
                                            }
                                        </style>

                                        <div class="container-fluid" id="preloaded_div"></div>
                                    </div>
                                </section>


                                <section class="col-lg-6 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="box box-solid ">
                                        <div class="box-header bg-teal-gradient">
                                            <i class="fa fa-th"></i>

                                            <h3 class="box-title">Advance Cutting List</h3>

                                            <div class="box-tools pull-right">
                                                <button class="btn bg-red btn-sm" id="reload_cutting"><i class="fa fa-refresh"></i></button>
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
                                                        <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_cutting" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="End Date" autocomplete="off" id="end_date_cutting" class="form-control">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <button class="btn btn-primary btn-block" id="search_date_cutting">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="table-responsive">
                                                <table id="table_cuttings" class="table table-border table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4">Page</th>
                                                            <th colspan="2" id="p_total">{{ random_int(1000, 12000) }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="4">Total</th>
                                                            <th colspan="2" id="total">{{ random_int(1000, 12000) }}</th>
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

                                                <h3 class="box-title">Weekly Bill Payments</h3>

                                                <div class="box-tools pull-right">
                                                    <button class="btn bg-red btn-sm" id="reload_mp_pay"><i class="fa fa-refresh"></i></button>
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
                                                                <input type="text" placeholder="Start Date" autocomplete="off" id="start_date_mp_pay" class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" placeholder="End Date" autocomplete="off" id="end_date_mp_pay" class="form-control">
                                                            </div>

                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary btn-block" id="search_date_mp_pay">Search</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table id="mp_pay" class="table table-border table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Name</th>
                                                                <th>Description</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="4">Page</th>
                                                                <th colspan="2" id="p_total">{{ random_int(1000, 12000) }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="4">Total</th>
                                                                <th colspan="2" id="total">{{ random_int(1000, 12000) }}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </section>

                                    </div>
                                    <!-- /.row (main row) -->
                                </section>
                                    
                                    
                                    
                                    <div id="CreateBillModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Bill</h4>
              </div>
              <form id="createBillForm" action="" method="post">
                <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
    <style>
        .current{
            display: block;
        }
        .steps:not(.current){
            display: none;
        }
    </style>
              <div class="modal-body">
                <section class="steps">
                    <div class="first_date_group form-group">
                      <label for="rate" class="control-label">Start Date</label>
                      <!--<div class="col-sm-9">-->
                        <div class="input-group">
                          <input type="text" data-intype="date" class="first_date form-control" name="rate" placeholder="yyyy-mm-dd" autocomplete="off">
                          <span class="input-group-addon"><i class="fa fa-times"></i></span>
                        </div>
    
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                
                    <div class="last_date_group form-group">
                      <label for="rate" class="control-label">Last Date</label>
                      <!--<div class="col-sm-9">-->
                        <div class="input-group">
                          <input type="text" data-intype="date" class="last_date form-control" name="rate" placeholder="yyyy-mm-dd" autocomplete="off">
                          <span class="input-group-addon"><i class="fa fa-times"></i></span>
                        </div>
    
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                </section>
                
                <section class="steps">
                    <div class="panel panel-success">
                        <div class="delevery-title panel-heading"></div>
                        <div class="panel-body">
                            <table class="deleveries table table-border">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th colspan="2" id="total_amount"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
                
                <section class="steps">
                    <div class="sub_total_group form-group">
                      <label for="rate" class="control-label">Sub Total</label>
                      <!--<div class="col-sm-9">-->
                          <input type="number" disabled="disabled" class="amount form-control" name="rate" placeholder="Product price" autocomplete="off">
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                    
                    
                    <div class="previous_due_group form-group">
                      <label for="rate" class="control-label">Previous Due</label>
                      <!--<div class="col-sm-9">-->
                          <input type="number" disabled="disabled" class="previous_due form-control" name="rate" placeholder="Previous due" autocomplete="off">
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                    
                    <div class="transport_group form-group">
                      <label for="rate" class="control-label">Transport</label>
                      <!--<div class="col-sm-9">-->
                          <input type="number" class="transport form-control" name="rate" placeholder="Transport Cost" autocomplete="off" value="0">
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                    
                    
                    <div class="advance_cutting_group form-group">
                      <label for="rate" class="control-label">Advance Cutting</label>
                      <!--<div class="col-sm-9">-->
                          <input type="number" class="advance_cutting form-control" name="rate" placeholder="Advance cutting" autocomplete="off">
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                    
                    <div class="total_group form-group">
                      <label for="rate" class="control-label">Total</label>
                      <!--<div class="col-sm-9">-->
                          <input type="text" disabled="disabled" class="total form-control" name="rate" placeholder="yyyy-mm-dd" autocomplete="off">
                        <div class="invalid-feedback"></div>
                      <!--</div>-->
                    </div>
                    
                </section>
                
              </div>
    
              <div class="modal-footer">
                <button type="button" class="previous btn btn-info pull-left">Previous</button>
                <button type="button" class="next btn btn-primary pull-right">Next</button>
                <button type="submit" id="btn-submit" class="submit btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
                                @include('pages.party.model')

                                @endsection

                                @section('script')

                                <script>
                                    $(document).ready(function() {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-Token': '{{ csrf_token() }}'
                                            }
                                        });
                                        
                                        let party_id = "{{ $id }}";
                                        
                                        let c = {
                                            allow_daily_advance: undefined,
                                            allow_advance: undefined,
                                            allow_preload: undefined,
                                            allow_damage: undefined,
                                        };
                                        
                                        getPartyDetail();
                                        function getPartyDetail(){
                                            $.ajax({
                                                url : "{{ route('party.account.pdetail') }}",
                                                method : 'post',
                                                dataType : 'json',
                                                data : {
                                                    id : party_id
                                                },
                                                beforeSend : function(){
                                                    
                                                }, 
                                                success : function(res){
                                                    $('#party_name').text(res.name);
                                                    $('#party_address').text(res.address);
                                                    $('#party_phone').text(res.phone);
                                                    $('#production_rate').text(res.rate);
                                                    $('#reduce_rate').text(res.cutting_rate);
                                                    if(res.allow_damage == 'true'){
                                                    $('#production').text(res.production + ' | '+res.cutted);
                                                    }else{
                                                    $('#production').text(res.production);
                                                    }
                                                    $('#total_selery').text(res.selery);
                                                    $('#total_paid').text(res.paid);
                                                    $('#party_balance').text(res.balance);
                                                    
                                                    
                                                    c.allow_daily_advance = res.allow_daily_advance;
                                                    c.allow_advance = res.allow_advance;
                                                    c.allow_preload = res.allow_preload;
                                                    c.allow_damage = res.allow_damage;
                                                    ValidateTabs();
                                                },
                                                error: function(xhr, status, error) {
                                                    $('#console').html(xhr.responseText);
                                                }
                                            });
                                        }
                                        
                                        getPartyDetailAfterBill();
                                        function getPartyDetailAfterBill(){
                                            $.ajax({
                                                url : "{{ route('party.account.pdAfterBill') }}",
                                                method : 'post',
                                                dataType : 'json',
                                                data : {
                                                    id : party_id
                                                },
                                                beforeSend : function(){
                                                    $('#this_week_overlay').show();
                                                },
                                                success : function(res){
                                                    $('#this_week_overlay').hide();
                                                    $('#production_this_week').text(res.production);
                                                    $('#total_selery_this_week').text(res.selery);
                                                    $('#total_paid_this_week').text(res.paid);
                                                    $('#balance_this_week').text(res.balance);
                                                    
                                                    $('#start_day').text(res.title_start);
                                                    $('#end_day').text(res.title_end);
                                                },
                                                error: function(xhr, status, error) {
                                                    $('#console').html(xhr.responseText);
                                                    alert('something wrong');
                                                }
                                            });
                                        }

                                        function ValidateTabs() {
                                            if (c.allow_daily_advance == 'true') {
                                                $('#advance div.disable').hide();
                                            } else {
                                                $('#advance div.disable').show();
                                            }

                                            if (c.allow_preload == 'true') {
                                                $('#preloaded div.disable').hide();
                                            } else {
                                                $('#preloaded div.disable').show();
                                            }

                                            if (c.allow_advance == 'true') {
                                                $('#advance_adjust div.disable').hide();
                                            } else {
                                                $('#advance_adjust div.disable').show();
                                            }
                                        }

                                        const form = '#entry_form';

                                        $('#add_party_entry').click(function(e) {
                                            e.preventDefault();
                                            $(form + ' .name').val($(this).data('name'));
                                            $(form + ' .party_id').val($(this).data('id'));
                                            $('#add_party_entry_modal').modal('show');
                                        });

                                        $(form).submit(function(e) {
                                            e.preventDefault();

                                            let _data = {
                                                party_id: $(form + ' .party_id').val(),
                                                description: $(form + ' .description').val(),
                                                quantity: $(form + ' .quantity').val()
                                            };

                                            $.ajax({
                                                url: '{{ route('party.production.store') }}',
                                                method: 'post',
                                                dataType: 'json',
                                                data: _data,
                                                beforeSend: function() {
                                                    $(form + ' .form-group').removeClass('has-feedback has-error');
                                                    $(form + ' .invalid-feedback').text('');
                                                },
                                                success: function(res) {
                                                    Swal(res.t, res.m, res.s);
                                                    if(res.s == 'success'){
                                                        getPartyDetailAfterBill();
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    $('#console').html(xhr.responseText);

                                                    let errors = xhr.responseJSON.errors;
                                                    $.each(errors, function(key, item) {
                                                        let group = form + ' .'+ key + '_group';
                                                        $(group).addClass('has-error has-feedback');
                                                        $(group +' .invalid-feedback').text(item);
                                                    });
                                                }
                                            });
                                        });

                                        let item = {
                                            rate: 0
                                        };
                                        //getRate($('#preload_form select.item_id').val());
                                        function getRate(id) {
                                            if (id.length > 0) {
                                                $.ajax({
                                                    url: '{{ route('item.rate') }}',
                                                    method: 'post',
                                                    dataType: 'json',
                                                    data: {
                                                        id: id
                                                    },
                                                    success: function(res) {
                                                        item.rate = res.rate;
                                                    },
                                                    error: function() {
                                                        alert('something wrong');
                                                    }
                                                });
                                            }
                                        }

                                        $('#preload_form').submit(function(e) {
                                            e.preventDefault();
                                            let form = '#preload_form';
                                            let _data = {
                                                party_id: '{{ $id }}',
                                                item_id: $(form + ' select.item_id').val(),
                                                quantity: $(form + ' input.quantity').val(),
                                                description: $(form + ' input.description').val(),
                                                amount: $(form + ' input.amount').val(),
                                            };

                                            $.ajax({
                                                url: '{{ route('party.preload.store') }}',
                                                method: 'post',
                                                dataType: 'json',
                                                data: _data,
                                                beforeSend: function() {
                                                    $(form + ' .form-group').removeClass('has-feedback has-error');
                                                    $(form + ' .invalid-feedback').text('');
                                                },
                                                success: function(res) {
                                                    Swal(res.t, res.m, res.s);
                                                    $(form)[0].reset();
                                                    $(form + ' .amount_group .input-group-addon').html('');
                                                },
                                                error: function(xhr, status, error) {
                                                    $('#console').html(xhr.responseText);

                                                    let errors = xhr.responseJSON.errors;
                                                    $.each(errors, function(key, item) {
                                                        let group = form + ' .'+ key + '_group';
                                                        $(group).addClass('has-error has-feedback');
                                                        $(group +' .invalid-feedback').text(item);
                                                    });
                                                }
                                            });
                                        });

                                        $('#preload_form input.quantity').keyup(function() {
                                            setAddon();
                                        });

                                        $('#preload_form select.item_id').change(function() {
                                            getRate($(this).val());
                                            setAddon();
                                        });

                                        function setAddon() {
                                            let form = '#preload_form';
                                            let quantity = $(form + ' input.quantity').val();
                                            if (quantity.length == 0) {
                                                quantity = 0;
                                            }
                                            let space = $(form + ' .amount_group .input-group-addon');
                                            let text = item.rate + ' &times; ' + quantity;
                                            space.html(text);
                                            $(form + ' input.amount').val(item.rate * quantity);
                                        }

                                        $('#advance_form').submit(function(e) {
                                            e.preventDefault();
                                            StoreDailyPayment();
                                        });

                                        $('#bill_form').submit(function(e) {
                                            e.preventDefault();
                                            StoreBill();
                                        });
                                        
                                        $('#advance_cutting_form').submit(function(e){
                                            e.preventDefault();
                                            StoreAdvanceCutting();
                                        });

                                        function StoreDailyPayment() {
                                            let form = "#advance_form";
                                            let payment_type = $(form + ' select.payment_type').val();
                                            let route = '';
                                            if (payment_type == 'bill') {
                                                route = "{{ route('party.bill.store') }}";
                                            } else {
                                                route = "{{ route('party.daily_advance.store') }}";
                                            }

                                            let _data = {
                                                party_id: '{{ $id }}',
                                                description: $(form + ' input.description').val(),
                                                amount: $(form + ' input.amount').val()
                                            };

                                            $.ajax({
                                                url: '{{ route('party.daily_advance.store') }}',
                                                method: 'post',
                                                dataType: 'json',
                                                data: _data,
                                                beforeSend: function() {
                                                    $(form + ' .overlay').show();
                                                    $(form + ' .form-group').removeClass('has-error has-feedback');
                                                    $(form + ' .invalid-feedback').text('');
                                                },
                                                success: function(res) {
                                                    $(form + ' .overlay').hide();
                                                    Swal(res.t, res.m, res.s);
                                                    $(form)[0].reset();

                                                },
                                                error: function(xhr, status, error) {
                                                    $(form + ' .overlay').hide();
                                                    $('#console').html(xhr.responseText);

                                                    let errors = xhr.responseJSON.errors;
                                                    $.each(errors, function(key, item) {
                                                        let group = form + ' .'+ key + '_group';
                                                        $(group).addClass('has-error has-feedback');
                                                        $(group +' .invalid-feedback').text(item);
                                                    });
                                                }
                                            });
                                        }

                                        function StoreBill() {
                                            let form = "#bill_form";

                                            let _data = {
                                                party_id: '{{ $id }}',
                                                description: $(form + ' input.description').val(),
                                                amount: $(form + ' input.amount').val()
                                            };

                                            $.ajax({
                                                url: "{{ route('party.bill.store') }}",
                                                method: 'post',
                                                dataType: 'json',
                                                data: _data,
                                                beforeSend: function() {
                                                    $(form + ' .overlay').show();
                                                    $(form + ' .form-group').removeClass('has-error has-feedback');
                                                    $(form + ' .invalid-feedback').text('');
                                                },
                                                success: function(res) {
                                                    $(form + ' .overlay').hide();
                                                    Swal(res.t, res.m, res.s);
                                                    $(form)[0].reset();

                                                },
                                                error: function(xhr, status, error) {
                                                    $(form + ' .overlay').hide();
                                                    $('#console').html(xhr.responseText);

                                                    let errors = xhr.responseJSON.errors;
                                                    $.each(errors, function(key, item) {
                                                        let group = form + ' .'+ key + '_group';
                                                        $(group).addClass('has-error has-feedback');
                                                        $(group +' .invalid-feedback').text(item);
                                                    });
                                                }
                                            });
                                        }
                                        
                                        function StoreAdvanceCutting(){
                                            alert('do the task to store in db');
                                        }
                                        
                                      
                                      
                                      
                                      
                                      




                                    });
                                </script>

                                @endsection