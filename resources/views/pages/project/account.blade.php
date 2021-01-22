    @extends('layouts.master')
    
    @section('title')
      <title>Staff Account</title>
    @endsection
    
    
    @section('body')
      <section class="content-header">
          <h1>
            Project
            <small>{{ 'Project Name' }}</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('project.index') }}">Project</a></li>
            <li class="active"><a href="#">Account</a></li>
          </ol>
        </section>
    <pre id="console"></pre>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <section class="col-lg-6 connectedSortable">
              <div class="box box-solid ">
                <div class="box-header bg-teal-gradient">
                  <i class="fa fa-th"></i>
    
                  <h3 class="box-title">Project Detail</h3>
    
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
                          <b>Project Details</b>
                      </div>
    
                      <div class="panel-body">
                          <div class="form-horizontal">
                              <div class="form-group">
                                  <label for="name" class="col-xs-3">Project Name</label>
                                  <span class="col-xs-1">:</span>
                                  <div class="col-xs-7">
                                    <span><b id="pName"></b></span>
                                  </div>
                              </div>
    
                              <div class="form-group">
                                  <label for="name" class="col-xs-3">Project Owner</label>
                                  <span class="col-xs-1">:</span>
                                  <div class="col-xs-7">
                                    <span><b id="pLocation"></b></span>
                                  </div>
                              </div>
    
                              <div class="form-group">
                                  <label for="name" class="col-xs-3">Project Location</label>
                                  <span class="col-xs-1">:</span>
                                  <div class="col-xs-7">
                                    <span><b id="pOwner"></b></span>
                                  </div>
                              </div>
    
                              <div class="form-group">
                                  <label for="name" class="col-xs-3">Phone</label>
                                  <span class="col-xs-1">:</span>
                                  <div class="col-xs-7">
                                    <span><b id="pPhone"></b></span>
                                  </div>
                              </div>
    
                              <div class="form-group">
                                  <label for="name" class="col-xs-3">Email</label>
                                  <span class="col-xs-1">:</span>
                                  <div class="col-xs-7">
                                    <span><b id="pEmail"></b></span>
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
    
                  <h3 class="box-title">Delevery Summery</h3>
    
                  <div class="box-tools pull-right">
                    <button 
                    class="btn btn-danger btn-sm" 
                    id="createBill"
                    ><b>Create Bill</b></button>
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
                          <b>Delevery Details</b>
                      </div>
    
                      <div class="panel-body">
                        <table class="table table-border">
                          <thead>
                              <tr>
                                  <th>Product</th>
                                  <th>Total</th>
                                  <th>After Last Bill</th>
                              </tr>
                          </thead>
                          <tbody id="deleverySum"></tbody>
                        </table>
                        
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
    
                  <h3 class="box-title">Bills</h3>
    
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
                          <b>Project Bills</b>
                      </div>
    
                      <div class="panel-body table-responsive">
                        <table id="ProjectBillTable" class="table table-border">
                          <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>Duration</th>
                                  <th>Amount</th>
                                  <th>Paid</th>
                                  <th>Due</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                        
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
                    <button class="btn btn-success" id="addPayment">Payment</button>
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
                          <b>Project Payments</b>
                      </div>
    
                      <div class="panel-body table-responsive">
                        <table id="ProjectPaymentTable" class="table table-border">
                          <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>Bill Of</th>
                                  <th>Description</th>
                                  <th>Amount</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                              <tr>
                                  <th colspan="3">Total</th>
                                  <th colspan="2" id="TotalPayment"></th>
                              </tr>
                          </tfoot>
                        </table>
                        
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
    
                  <h3 class="box-title">Advance</h3>
    
                  <div class="box-tools pull-right">
                    <button class="btn btn-success" id="addAdvance">Advance</button>
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
                          <b>Project Advance</b>
                      </div>
    
                      <div class="panel-body table-responsive">
                        <table id="ProjectAdvanceTable" class="table table-border">
                          <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>Description</th>
                                  <th>Amount</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                              <tr>
                                  <td colspan="2">Total</td>
                                  <td colspan="2" id="TotalAdvance"></td>
                              </tr>
                          </tfoot>
                        </table>
                        
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
    
                  <h3 class="box-title">Deliveries</h3>
    
                  <div class="box-tools pull-right">
                    <a href="{{ route('project.delevery') }}">Delivery</a>
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
    
                <div class="box-body border-radius-none">
                    <div class="table-responsive">
                      <table id="deliveryTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Delivery no</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Destination</th>
                                    <th>Driver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
    
    <div id="PaymentModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Project Payment</h4>
              </div>
              <form id="PaymentForm" action="" method="post">
              <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
              <div class="modal-body">
                
                    <div class="description_group form-group">
                      <label for="rate" class="control-label">Description</label>
                      <input type="text" class="description form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                
                    <div class="amount_group form-group">
                      <label for="rate" class="control-label">Amount</label>
                      <input type="text" data-intype="number" class="amount form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                
              </div>
    
              <div class="modal-footer">
                <button type="submit" class="submit btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
    <div id="EditPaymentModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Project Payment</h4>
              </div>
              <form id="EditPaymentForm" action="" method="post">
              <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
              <div class="modal-body">
                    <input type="hidden" name="" class="id">                
                    <div class="description_group form-group">
                      <label for="rate" class="control-label">Description</label>
                      <input type="text" class="description form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                
                    <div class="amount_group form-group">
                      <label for="rate" class="control-label">Amount</label>
                      <input type="text" data-intype="number" class="amount form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                
              </div>
    
              <div class="modal-footer">
                <button type="submit" class="submit btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
    <div id="AdvanceModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Project Advance</h4>
              </div>
              <form id="AdvanceForm" action="" method="post">
              <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
              <div class="modal-body">
                    
                    
                    <div class="description_group form-group">
                      <label for="rate" class="control-label">Description</label>
                      <input type="text" class="description form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="amount_group form-group">
                      <label for="rate" class="control-label">Amount</label>
                      <input type="text" data-intype="number" class="amount form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                
                
              </div>
    
              <div class="modal-footer">
                <button type="submit" class="submit btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
    <div id="EditAdvanceModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Project Advance</h4>
              </div>
              <form id="EditAdvanceForm" action="" method="post">
              <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
              <div class="modal-body">
                    
                    <input type="hidden" class="id">
                    <div class="description_group form-group">
                      <label for="rate" class="control-label">Description</label>
                      <input type="text" class="description form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="amount_group form-group">
                      <label for="rate" class="control-label">Amount</label>
                      <input type="text" data-intype="number" class="amount form-control" name="rate" placeholder="" autocomplete="off">
                      <div class="invalid-feedback"></div>
                    </div>
                
                
              </div>
    
              <div class="modal-footer">
                <button type="submit" class="submit btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
    <div id="EditDeleveryModel" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Delivery</h4>
              </div>
              <form id="EditDeleveryForm" action="" method="post">
              <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>
              <div class="modal-body">
                <input type="hidden" class="dId">
                <div class="dref_group form-group">
                  <label for="rate" class="control-label">Delivery No</label>
                  <input type="text" data-intype="number" class="dref form-control" name="rate" placeholder="" autocomplete="off">
                  <div class="invalid-feedback"></div>
                </div>
                
                <div class="product_id_group form-group">
                  <label for="rate" class="control-label">Product</label>
                  <select type="text" class="product_id form-control">
                      
                  </select>
                  <div class="invalid-feedback"></div>
                </div>
                
                <div class="quantity_group form-group">
                  <label for="rate" class="control-label">Quantity</label>
                  <input type="text" data-intype="number" class="quantity form-control" name="rate" placeholder="" autocomplete="off">
                  <div class="invalid-feedback"></div>
                </div>
                
                <div class="driver_group form-group">
                  <label for="rate" class="control-label">Driver</label>
                  <input type="text" class="driver form-control" name="rate" placeholder="" autocomplete="off">
                  <div class="invalid-feedback"></div>
                </div>
                
                <div class="destination_group form-group">
                  <label for="rate" class="control-label">Destination</label>
                  <input type="text" class="destination form-control" name="rate" placeholder="" autocomplete="off">
                  <div class="invalid-feedback"></div>
                </div>
                
              </div>
    
              <div class="modal-footer">
                <button type="submit" class="submit btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
    
    @endsection
    
    @section('script')
    
    <script>
        $(document).ready(function() {
          $.ajaxSetup({
            headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
          });
          
          let project_id = "{{ $id }}";
          getCustomerData(project_id);
          getDeliveryTable(project_id);
          
          function getCustomerData(id) {
            $.ajax({
              url : "{{ route('project.details') }}",
              method : "POST",
              dataType : "JSON",
              data : {id : id},
              beforeSend : function() {
                
              },
              success: function(res) {
                //showTabs();
                $('#pName').text(res.title);
                $('#pLocation').text(res.location);
                $('#pOwner').text(res.owner);
                $('#pPhone').text(res.phone);
                $('#pEmail').text(res.email);
              },
              error : function(xhr, status, error){
                $('#console').html(xhr.responseText);
              }
            });
            
            $.ajax({
              url : "{{ route('project.delevery.cinfo') }}",
              method : "POST",
              dataType : "JSON",
              data : {id : id},
              beforeSend : function() {
              },
              success: function(res) {
                $('#deleverySum').html(res.table);
              },
              error : function(xhr, status, error){
                $('#console').html(xhr.responseText);
              }
            });
          }
          
          function getDeliveryTable(id) {
            $.ajax({
              url : "{{ route('project.delevery.table') }}",
              method : "POST",
              dataType: "JSON",
              data : {id : id},
              beforeSend : function() {
                
              }, 
              success : function(res) {
                $('#deliveryTable tbody').html(res.tbody);
              },
              error : function(xhr, status, error){
                $('#console').html(xhr.responseText);
              }
            });
          }
          
          $('#createBill').click(function(e){
              e.preventDefault();
              NewBillDate();
              $('#CreateBillModal').modal('show');
          });
          
          $('input[data-intype="date"]').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-4d',
            todayBtn: true
          });
          
          $('input[data-intype="date"]').click(function(e){
              e.preventDefault();
              
          });
          
          let steps = $('section.steps');
          let form = '#createBillForm ';
          
          function navigateTo(index){
              steps.removeClass('current').eq(index).addClass('current');
              //steps.eq(index -1).removeClass('active').addClass('hidden').eq(index).addClass('active');
              $('button.previous').toggle(index > 0);
              let atTheEnd = index >= steps.length -1;
              $('button.next').toggle(!atTheEnd);
              $('#btn-submit').toggle(atTheEnd);
          }
          
          function curIndex(){
              return steps.index(steps.filter('.current'));
          }
          
          $('button.previous').click(function(){
              navigateTo(curIndex() - 1);
          });
          
          $('button.next').click(function(){
              if(curIndex() == 0){
                  SubmitDates();
              }else{
                  navigateTo(curIndex() + 1);
              }
          });
          
          navigateTo(0);
          
          function SubmitDates(){
              let _data = {
                  project_id : project_id,
                  first_date : $(form + 'input.first_date').val(),
                  last_date : $(form + 'input.last_date').val(),
              };
              
             if(_data.first_date == ''){
                  Swal('Empty Field', 'First date is required.', 'error');
              }else if(_data.last_date == ''){
                  Swal('Empty Field', 'Last date is required.', 'error');
              }else{
                  $.ajax({
                      url : "{{ route('project.account.dates') }}",
                      method : 'post',
                      dataType : 'json',
                      data : _data,
                      beforeSend : function(){
                          $(form + '.overlay').show();
                      },
                      success : function(res){
                          $(form + '.overlay').hide();
                          if(res.valid === false){
                              Swal(res.t, res.m, res.s);
                          }else{
                              $('.steps .delevery-title').text('Deliveries ' + res.title);
                              $('.steps .deleveries tbody').html(res.table);
                              $('#total_amount').text(res.total_amount);
                              $('.steps .amount').val(res.total_amount);
                              $('.steps .advance_cutting').val(res.remaining_advance);
                              $('.steps .previous_due').val(res.previous_due);
                              $('.steps .total').val(res.total_amount - res.remaining_advance + res.previous_due);
                              navigateTo(curIndex() + 1);
                          }
                      },
                      error : function(xhr, status, error){
                        $('#console').html(xhr.responseText);
                      }
                  });
              }
              
          }
          
          function calculate(){
              let form = '#createBillForm ';
              let x = {
                  'sub_total'     :    parseFloat($(form + 'input.amount').val()),
                  'advance_cutting' :   parseFloat($(form + 'input.advance_cutting').val()),
                  'transport'     :   parseFloat($(form + 'input.transport').val()),
                  'previous_due'  :   parseFloat($(form + 'input.previous_due').val())
              };
              
              if(isNaN(x.sub_total)){ x.sub_total = 0;}
              if(isNaN(x.advance_cutting)) {x.advance_cutting = 0;}
              if(isNaN(x.transport)) {x.transport = 0;}
              if(isNaN(x.previous_due)) {x.previous_due = 0;}
              
              let tot = x.sub_total + x.transport + x.previous_due;
              let total = tot - x.advance_cutting; 
              $(form + 'input.total').val(total);
          }
          
          $('#createBillForm input.transport, #createBillForm input.advance_cutting').keyup(function(){
              calculate();
          });
          
          $('#createBillForm').submit(function(e){
              e.preventDefault();
              let form = '#createBillForm ';
              let _data = {
                  'project_id'    :    '{{ $id }}',
                  'first_date'    :   $(form + 'input.first_date').val(),
                  'last_date'     :    $(form + 'input.last_date').val(),
                  'sub_total'     :    $(form + 'input.amount').val(),
                  'advance_cutting'    :   $(form + 'input.advance_cutting').val(),
                  'transport'     :   $(form + 'input.transport').val(),
                  'previous_due'  :   $(form + 'input.previous_due').val(),
                  'total'         :   $(form + 'input.total').val(),
              };
              
              $.ajax({
                  url : '{{ route("project.bill.store") }}',
                  method : 'post',
                  dataType : 'json',
                  data : _data,
                  beforeSend : function(){
                      $(form + '.overlay').show();
                      $(form + '.form-group').removeClass('has-error has-feedback');
                      $(form + '.invalid-feedback').text('');
                  },
                  success : function(res){
                      $(form + '.overlay').hide();
                      Swal(res.t, res.m, res.s);
                      if(res.s == 'success'){
                          $(form)[0].reset();
                          $('#CreateBillModal').modal('hide');
                          getBills();
                          getCustomerData(project_id);
                          navigateTo(0);
                      }
                  },
                  error : function(xhr, status, error){
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
          });
          getBills();
          function getBills(){
              $.ajax({
                  url : "{{ route('project.account.bills') }}",
                  method : 'post',
                  dataType : 'json',
                  data : {
                      project_id : project_id
                  },
                  beforeSend : function(){
                      
                  },
                  success : function(res){
                      $('#ProjectBillTable tbody').html(res.table);
                  },
                  error : function(xhr, status, error){
                    $('#console').html(xhr.responseText);
                  }
              });
          }
          
          function NewBillDate(){
              $.ajax({
                  url : '{{ route("project.account.firstDate") }}',
                  method : 'post',
                  dataType : 'json',
                  data : {
                      project_id : project_id
                  },
                  beforeSend : function(){
                      
                  }, 
                  success : function(res){
                      $('.steps .first_date').val(res.first_date);
                      $('.steps .last_date').val(res.last_date);
                  },
                  error : function(xhr, status, error){
                    $('#console').html(xhr.responseText);
                  }
              });
          }
          
          $('#addPayment').click(function(e){
              e.preventDefault();
              $('#PaymentModal').modal('show');
          });
          $('#addAdvance').click(function(e){
              e.preventDefault();
              $('#AdvanceModal').modal('show');
          });
          PaymentTable();
          AdvanceTable();
          function PaymentTable(){
              $.ajax({
                  url : "{{ route('project.account.payments') }}",
                  method : 'post',
                  dataType : 'json',
                  data : {
                      project_id
                  },
                  beforeSend : function(){
                      
                  },
                  success : function(res){
                      $('#ProjectPaymentTable tbody').html(res.table);
                      $('#ProjectPaymentTable #TotalPayment').html(res.total);
                  },
                  error : function(xhr, status, error){
                    $('#console').html(xhr.responseText);
                  }
              });
          }
          function AdvanceTable(){
              $.ajax({
                  url : "{{ route('project.account.advances') }}",
                  method : 'post',
                  dataType : 'json',
                  data : {
                      project_id
                  },
                  beforeSend : function(){
                      
                  },
                  success : function(res){
                      $('#ProjectAdvanceTable tbody').html(res.table);
                      $('#ProjectAdvanceTable #TotalAdvance').html(res.total);
                  },
                  error : function(xhr, status, error){
                    $('#console').html(xhr.responseText);
                  }
              });
          }
          
        $('#PaymentForm').submit(function(e){
              e.preventDefault();
              let form = '#PaymentForm ';
              let _data = {
                  description : $(form + 'input.description').val(),
                  amount : $(form + 'input.amount').val(),
                  project_id : project_id
              };
              
              $.ajax({
                  url : "{{ route('project.account.storePayment') }}",
                  method : 'post',
                  dataType : 'json',
                  data : _data,
                  beforeSend : function(){
                      $(form + '.overlay').show();
                      $(form + '.form-group').removeClass('has-error has-feedback');
                      $(form + '.invalid-feedback').text('');
                  },
                  success: function(res){
                      $(form + '.overlay').hide();
                      Swal(res.t, res.m, res.s);
                      if(res.s == 'success'){
                          PaymentTable();
                          getBills();
                          $('#PaymentModal').modal('hide');
                          $(form)[0].reset();
                      }
                  },
                  error : function(xhr, status, error){
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
          });
          
        $('#AdvanceForm').submit(function(e){
              e.preventDefault();
              let form = '#AdvanceForm ';
              let _data = {
                  amount : $(form + 'input.amount').val(),
                  description : $(form + 'input.description').val(),
                  project_id : project_id
              };
              
              $.ajax({
                  url : "{{ route('project.account.storeAdvance') }}",
                  method : 'post',
                  dataType : 'json',
                  data : _data,
                  beforeSend : function(){
                      $(form + '.overlay').show();
                      $(form + '.form-group').removeClass('has-feedback has-error');
                      $(form + '.invalid-feedback').text('');
                  },
                  success: function(res){
                      $(form + '.overlay').hide();
                      Swal(res.t, res.m, res.s);
                      if(res.s == 'success'){
                          AdvanceTable();
                          $('#AdvanceModal').modal('hide');
                          $(form)[0].reset();
                      }
                  },
                  error : function(xhr, status, error){
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
          });
          
        $('#ProjectBillTable').on('click', 'a.btn-delete', function(e){
              e.preventDefault();
              let id = $(this).data('id');
              deleteBill(id);
          });
          
        function deleteBill(id){
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently! But you can delete bill only when no payment is stored.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve){
                       
                     $.ajax({
                        url: '{{ route('project.bill.delete') }}',
                        type: 'post',
                        data: {id : id},
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal(response.t, response.m, response.s);
                        getBills();
                        getCustomerData(project_id);
                     })
                     .fail(function(){
                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                     });
                  });
                },
                allowOutsideClick: false              
            });  
        }
        
        $('#deliveryTable').on('click', 'a.btn-edit', function(e){
            e.preventDefault();
            let form = '#EditDeleveryForm ';
            $(form)[0].reset();
            let id = $(this).data('id');
            $('#EditDeleveryForm input.dId').val(id);
            getReleventProducts(project_id);
            $.ajax({
                url : "{{ route('project.delevery.info') }}",
                method : 'post',
                dataType : 'json',
                data : {
                    id : id
                },
                beforeSend : function(){
                    
                },
                success : function(res){
                    $(form + 'input.dref').val(res.dref);
                    $(form + 'select.product_id').val(res.product_id);
                    $(form + 'input.quantity').val(res.quantity);
                    $(form + 'input.driver').val(res.driver);
                    $(form + 'input.destination').val(res.destination);
                }
            });
            $('#EditDeleveryModel').modal('show');
        });
        
        function getReleventProducts(project_id){
            $.ajax({
              url : "{{ route('project.delevery.products') }}",
              method : "POST",
              dataType : "JSON",
              data : {id : project_id},
              beforeSend : function() {
                
              },
              success: function(res) {
                $('#EditDeleveryForm select.product_id').html(res.options);
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
            });
          }
        
        $('#EditDeleveryForm').submit(function(e){
            e.preventDefault();
            let form = '#EditDeleveryForm ';
            let _data = {
                id : $(form + 'input.dId').val(),
                dref : $(form + 'input.dref').val(),
                product_id : $(form + 'select.product_id').val(),
                quantity : $(form + 'input.quantity').val(),
                driver : $(form + 'input.driver').val(),
                destination : $(form + 'input.destination').val(),
            };
            
            $.ajax({
                url : "{{ route('project.delevery.update') }}",
                method : 'post',
                dataType : 'json',
                data : _data,
                beforeSend : function(){
                    $(form + '.overlay').show();
                },
                success : function(res){
                    $(form + '.overlay').hide();
                    Swal(res.t, res.m, res.s);
                    if(res.s == 'success'){
                        $('#EditDeleveryModel').modal('hide');
                        getDeliveryTable(project_id);
                        getCustomerData(project_id);
                    }
                },
                  error : function(xhr, status, error){
                    $(form + ' .overlay').hide();
                    $('#console').html(xhr.responseText);
                    
                  }
                
            });
        });
        
        $('#deliveryTable').on('click', 'a.btn-delete', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            deleteDelivery(id);
        });
        
        
        function deleteDelivery(id){
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently! But you can delete delivery only when the delivery is not included to any bill.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve){
                       
                     $.ajax({
                        url: '{{ route('project.delevery.delete') }}',
                        type: 'post',
                        data: {id : id},
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal(response.t, response.m, response.s);
                        getDeliveryTable(project_id);
                        getCustomerData(project_id);
                     })
                     .fail(function(){
                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                     });
                  });
                },
                allowOutsideClick: false              
            });  
        }
        
        $('#ProjectPaymentTable').on('click', 'a.btn-edit', function(e){
            e.preventDefault();
            $('#EditPaymentForm')[0].reset();
            let id = $(this).data('id');
            $('#EditPaymentModal').modal('show');
            $('#EditPaymentForm input.id').val(id);
            $.ajax({
                method : 'post',
                url : "{{ route('project.payment.info') }}",
                dataType : 'json',
                data : {
                    id : id
                },
                beforeSend : function(){
                    $('#EditPaymentForm .overlay').show();
                }, 
                success : function(res){
                    $('#EditPaymentForm input.description').val(res.description);
                    $('#EditPaymentForm input.amount').val(res.amount);
                    $('#EditPaymentForm .overlay').hide();
                },
                error : function(xhr, status, error){
                    $('#EditPaymentForm .overlay').hide();
                    $('#console').html(xhr.responseText);
                }
            });
        });
        
        $('#EditPaymentForm').submit(function(e){
            e.preventDefault();
            let form = '#EditPaymentForm ';
            let _data = {
                id : $(form + 'input.id').val(),
                description : $(form + 'input.description').val(),
                amount : $(form + 'input.amount').val(),
            };
            
            $.ajax({
                url : "{{ route('project.payment.update') }}",
                method : 'post',
                dataType : 'json',
                data : _data,
                beforeSend : function(){
                    $(form + '.overlay').show();
                },
                success : function(res){
                    $(form + '.overlay').hide();
                    Swal(res.t, res.m, res.s);
                    if(res.s == 'success'){
                        $('#EditPaymentModal').modal('hide');
                        getCustomerData(project_id);
                        PaymentTable(project_id);
                        getBills();
                    }
                },
                error : function(xhr, status, error){
                    $('#EditPaymentForm .overlay').hide();
                    $('#console').html(xhr.responseText);
                }
            });
        });
        
        $('#ProjectPaymentTable').on('click', 'a.btn-delete', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            deletePayment(id);
        });
        
        function deletePayment(id){
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently! But you can delete payment of current bill.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve){
                       
                     $.ajax({
                        url: '{{ route('project.payment.delete') }}',
                        type: 'post',
                        data: {id : id},
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal(response.t, response.m, response.s);
                        getCustomerData(project_id);
                        PaymentTable(project_id);
                        getBills();
                     })
                     .fail(function(){
                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                     });
                  });
                },
                allowOutsideClick: false              
            });  
        }
        
          $('#ProjectAdvanceTable').on('click', 'a.btn-edit', function(e){
              e.preventDefault();
              let id = $(this).data('id');
              $('#EditAdvanceForm input.id').val(id);
              $('#EditAdvanceModal').modal('show');
              $.ajax({
                  url : "{{ route('project.advance.info') }}",
                  method : 'post',
                  dataType : 'json',
                  data : {
                      id : id
                  },
                  beforeSend : function(){
                      $('#EditAdvanceForm .overlay').show();
                  },
                  success : function(res){
                      $('#EditAdvanceForm .overlay').hide();
                      $('#EditAdvanceForm input.description').val(res.description);
                      $('#EditAdvanceForm input.amount').val(res.amount);
                  },
                  error : function(xhr, status, error){
                    $('#EditAdvanceForm .overlay').hide();
                    $('#console').html(xhr.responseText);
                  }
                  
              });
          });
          
          $('#EditAdvanceForm').submit(function(e){
              e.preventDefault();
              let form = '#EditAdvanceForm ';
              let _data = {
                  id : $(form + 'input.id').val(),
                  description : $(form + 'input.description').val(),
                  amount : $(form + 'input.amount').val(),
              };
              
              $.ajax({
                  url : "{{ route('project.advance.update') }}",
                  method : 'post',
                  dataType : 'json',
                  data : _data,
                  beforeSend : function(){
                      $(form + '.overlay').show();
                  },
                  success : function(res){
                      $(form + '.overlay').hide();
                      Swal(res.t, res.m, res.s);
                      if(res.s == 'success'){
                          $('#EditAdvanceModal').modal('hide');
                          AdvanceTable();
                      }
                  },
                  error : function(xhr, status, error){
                    $('#EditAdvanceForm .overlay').hide();
                    $('#console').html(xhr.responseText);
                  }
              });
          });
        
          $('#ProjectAdvanceTable').on('click', 'a.btn-delete', function(e){
              e.preventDefault();
              let id = $(this).data('id');
              deletePayment(id);
          });
          
           function deletePayment(id){
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently! But you can delete advance which is not included any to any bill.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve){
                       
                     $.ajax({
                        url: '{{ route('project.advance.delete') }}',
                        type: 'post',
                        data: {id : id},
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal(response.t, response.m, response.s);
                        AdvanceTable();
                     })
                     .fail(function(){
                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                     });
                  });
                },
                allowOutsideClick: false              
            });  
        }
        
          
          
        });
    </script>
    
    @endsection