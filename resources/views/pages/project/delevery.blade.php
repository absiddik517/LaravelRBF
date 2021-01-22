@extends('layouts.master')

@section('title')
  <title>RBF - Delivery</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Delivery 
        <small>Project Product Delivery</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li lass="active"><a href="/">Delevery</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<pre id="console"></pre>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid" style="">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Select Project</h3>

              <div class="box-tools pull-right">
                <a href="{{ route('delivery.add') }}" class="btn bg-teal btn-sm">Normal
                </a>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <form class="form-horizontal" id="StepFrom">
                <div class="project_id_group form-group">
                  <label for="ref" class="col-sm-3 control-label">Projects</label>

                  <div class="col-sm-9">
                    <div class="input-group">
                      <select class="project_id form-control">
                          <option value="">Select One</option>
                          @php
                             $projects = App\Model\Project::all();
                          @endphp
                          @foreach ($projects as $product)
                            <option value="{{ $product['id'] }}">{{ $product['title']."  (". $product['owner'].")"  }}</option>
                          @endforeach
                      </select>
                      <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="nextStep" class="btn btn-info pull-right">Next</button>
              </div>
            </form>
              <!-- /.box-footer -->
          </div>


          <div class="box box-solid">
            <div class="overlay" id="d_overlay"><img src="images/spinner.gif"></div>
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Product Delivery</h3>

              <div class="box-tools pull-right">
                <span id="d_loader" class="align_center d_none"><img src="images/spinner.gif"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none" id="deleveryProductBody">
              <form class="form-horizontal" id="deliveryForm">
              
                <div class="dref_group form-group">
                  <label for="d_ref" class="col-sm-3 control-label">Delivery No.</label>

                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="dref form-control" id="d_ref" placeholder="Delivery No">
                    <span class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="product_id_group form-group">
                  <label for="quantity" class="col-sm-3 control-label">Product</label>

                  <div class="col-sm-9">
                    <select class="product_id form-control">
                        <option value="">Select Product</option>
                    </select>
                    <span class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="quantity_group form-group">
                  <label for="quantity" class="col-sm-3 control-label">Quantity</label>

                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="quantity form-control" id="quantity" placeholder="Quantity" autocomplete="off">
                    <span class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="driver_group form-group">
                  <label for="driver" class="col-sm-3 control-label">Driver</label>

                  <div class="col-sm-9">
                    <input type="text" class="driver form-control" autocomplete="off" id="driver" placeholder="Driver">
                    <span class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="destination_group form-group">
                  <label for="destination" class="col-sm-3 control-label">Destination</label>

                  <div class="col-sm-9">
                    <input type="text" class="destination form-control" autocomplete="off" id="destination" placeholder="Destination">
                  </div>
                </div>

                </form>
              </div>

              <div class="box-footer" id="deleveryProductFooter">
                <span class="pull-right">
                  <button type="submit" class="btn btn-primary" id="deleverySubmitAndPrint"><i class="fa fa-print"></i> Submit & Print</button> &nbsp;
                  <button type="submit" id="deliverySubmit" class="btn btn-info pull-right">Submit</button>
                </span>
              </div>
          </div>


        </section>

        <section class="col-lg-5 connectedSortable">
          <!-- customer info -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Project Information</h3>

              <div class="box-tools pull-right">
                <span class="align_center d_none"><img src="images/spinner.gif"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none" id="csInfo" style="position: relative;">
              <div class="overlay" id="ci_loader"><img src="images/spinner.gif"></div>
              <form class="form-horizontal" id="customerinfo">
              <style>
                .form-control-2{
                  width: 100%;
                  padding: 5px 5px;
                  border: none;
                  background: transparent;
                }
              </style>  
                <div class="form-group">
                  <label for="cName" class="col-xs-4 control-label">Project Name</label>

                  <div class="col-xs-8">
                    <input disabled type="text" class="form-control-2" id="pName">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cAddress" class="col-xs-4 control-label">Location</label>

                  <div class="col-xs-8">
                    <input disabled type="text" class="form-control-2" id="pLocation">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cAddress" class="col-xs-4 control-label">Owner</label>

                  <div class="col-xs-8">
                    <input disabled type="text" class="form-control-2" id="pOwner">
                  </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"><strong>Deliveries</strong></div>
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

                </form>
              </div>

          </div>



          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Delevery History</h3>

              <div class="box-tools pull-right">
                <span id="ho_loader" class="align_center d_none"><img src="images/spinner.gif"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

              <div class="box-body border-radius-none" id="csDel" style="position: relative;">
                <div class="overlay" id="dh_loader"><img src="images/spinner.gif"></div>
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
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
              </div>

          </div>
        </section>



      </div>
      <!-- /.row (main row) -->
    </section>

@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });
      $('#StepFrom select.project_id').val('');
      $('#customerinfo')[0].reset();
      $('#nextStep').attr('disabled', 'disabled');
      hideTabs();
      function hideTabs() {
        $('#csInfo').hide(300);
        $('#csDel').hide(300);
        $('#deleveryProductFooter').hide(300);
        $('#deleveryProductBody').hide(300);
      }

      function showTabs() {
        $('#csInfo').show(300);
        $('#csDel').show(300);
        $('#deleveryProductFooter').show(300);
        $('#deleveryProductBody').show(300);
      }
      $('#StepFrom select.project_id').change(function() {
        hideTabs();
        let id = $(this).val();
        if(id.length != 0){
          $.ajax({
            url : "{{ route('project.delevery.checkId') }}",
            method: "POST",
            dataType : "JSON",
            data : {id : id},
            beforeSend : function() {
              $('#StepFrom .project_id_group .input-group-addon').html('<img src="{{ asset('images/system/spinner.gif') }}" />');
            },
            success: function(res) {
              if(res.isValid === true){
                $('#StepFrom .input-group-addon').html("<i class='fa fa-check'></i>");
                $('#StepFrom .project_id_group').removeClass('has-error');
                $('#StepFrom .project_id_group').addClass('has-success');
                $('#StepFrom .project_id_group .invalid-feedback').text('');
                $('#nextStep').removeAttr('disabled');
              }else{
                $('#nextStep').attr('disabled', 'disabled');
                $('#StepFrom .project_id_group').removeClass('has-sucess');
                $('#StepFrom .project_id_group').addClass('has-error');
                $('#StepFrom .project_id_group .input-group-addon').html("<i class='fa fa-times'></i>");
                $('#StepFrom .project_id_group .invalid-feedback').text(res.msg);
              }

            }
          });
        }else{
          $('#refGroup').removeClass('has-error has-success');
          $('#StepFrom .input-group-addon').html("<i class='fa fa-times'></i>");
          $('#refMsg').text('');

        }
      });

      $('#nextStep').click(function(e) {
        e.preventDefault();
        let id = $('#StepFrom select.project_id').val();
        if(id.length > 0){
          getCustomerData(id);
          getDeliveryTable(id);
          getReleventProducts(id);
        }
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
            $('#deliveryForm select.product_id').html(res.options);
          },
          error: function (xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }

      function getCustomerData(id) {
        $.ajax({
          url : "{{ route('project.delevery.cinfo') }}",
          method : "POST",
          dataType : "JSON",
          data : {id : id},
          beforeSend : function() {
            
          },
          success: function(res) {
            showTabs();
            $('#pName').val(res.name);
            $('#pLocation').val(res.locations);
            $('#pOwner').val(res.owner);
            $('#deleverySum').html(res.table);
            $('#deliveryForm input.destination').val(res.locations);
          },
          error : function(xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }

      newDRef();
      function newDRef() {
        $.ajax({
          url : "{{ route('newDRef') }}",
          method : "POST",
          dataType : "JSON",
          data : {},
          beforeSend : function() {
            
          },
          success : function(res) {
            $('#d_ref').val(res);
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
            console.log(res);
          },
          error : function(xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }

      $('#deliverySubmit').click(function(e) {
        e.preventDefault();
        StoreDeliveryData();
      });

      function StoreDeliveryData() {
        let form = '#deliveryForm ';
        let _data = {
          project_id  : $('#StepFrom select.project_id').val(),
          product_id  : $(form + 'select.product_id').val(),
          dref        : $(form + 'input.dref').val(),
          quantity    : $(form + 'input.quantity').val(),
          driver      : $(form + 'input.driver').val(),
          destination : $(form + 'input.destination').val()
        };

        $.ajax({
          url : "{{ route('project.delevery.store') }}",
          method : "POST",
          dataType : "JSON",
          data : _data,
          beforeSend : function() {
            $(form + '.form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').html('&nbsp;');
          },
          success : function(res) {
            Swal(res.t, res.m, res.s);
            if(res.s == 'success'){
                $(form)[0].reset();
                newDRef();
                getCustomerData(_data.project_id);
                getDeliveryTable(_data.project_id);
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
      }

      // copyed 

      $('#ref').keydown(function() {
        /**   *      Hide cradintioal for every key stroke       *   **/ 
           hideTabs();
           $('#cName').val('');
           $('#cAddress').val('');
           $('#cProduct').val('');
           $('#cQuantity').val('');
           $('#cDeleveryDue').val('');
           $('#deliveryTable').html('');
      });



    });
  </script>
@endsection