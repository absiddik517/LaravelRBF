@extends('layouts.master')

@section('title')
  <title>RBF - Delivery</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Delivery
        <small>Delivery Customer Product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li lass="active"><a href="/delevery">Delevery</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid" style="">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Insert Reference</h3>

              <div class="box-tools pull-right">
                <a class="btn bg-teal btn-sm" href="{{ route('project.delevery') }}">Project
                </a>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <form class="form-horizontal" id="StepFrom">
                <div class="form-group" id="refGroup">
                  <label for="ref" class="col-sm-3 control-label">Reference</label>

                  <div class="col-sm-9">
                    <div class="input-group">
                      <input type="text" class="form-control" id="ref" data-intype="number" placeholder="Reference" autocomplete="off">
                      <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>
                    <span id="feedbackRef"></span>
                    <span class="help-block" id="refMsg"></span>
                  </div>
                </div>

              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="nextStep">Next</button>
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
              
                <div class="form-group" id="d_ref_group">
                  <label for="d_ref" class="col-sm-3 control-label">Delivery No.</label>

                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="d_ref" placeholder="Delivery No">
                    <span id="dRefFeedback"></span>
                    <span id="delMsg" class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="form-group" id="quantity_group">
                  <label for="quantity" class="col-sm-3 control-label">Quantity</label>

                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="quantity" placeholder="Quantity" autocomplete="off">
                    <span class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="form-group" id="driver_group">
                  <label for="driver" class="col-sm-3 control-label">Driver</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" autocomplete="off" id="driver" placeholder="Driver">
                    <span class="invalid-feedback">&nbsp;</span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="destination" class="col-sm-3 control-label">Destination</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" autocomplete="off" id="destination" placeholder="Destination">
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

              <h3 class="box-title">Customer Information</h3>

              <div class="box-tools pull-right">
                <span class="align_center d_none"><img src="images/spinner.gif"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none" id="csInfo" style="position: relative;">
              <div class="overlay" id="ci_loader"><img src="images/spinner.gif"></div>
              <form class="form-horizontal">
              <style>
                .form-control-2{
                  width: 100%;
                  padding: 5px 5px;
                  border: none;
                  background: transparent;
                }
              </style>  
                <div class="form-group">
                  <label for="cName" class="col-sm-4 control-label">Name</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control-2" id="cName">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cAddress" class="col-sm-4 control-label">Address</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control-2" id="cAddress">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cProduct" class="col-sm-4 control-label">Product</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control-2" id="cProduct">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cQuantity" class="col-sm-4 control-label">Quantity</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control-2" id="cQuantity">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cDeleveryDue" class="col-sm-4 control-label">Delivery Due</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control-2" id="cDeleveryDue">
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
                <div id="deliveryTable"></div>
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
      
      $('#ref').keyup(function() {
        let ref = $(this).val();
        if(ref.length != 0){
          $.ajax({
            url : "{{ route('ChechRef') }}",
            method: "POST",
            dataType : "JSON",
            data : {ref : ref},
            beforeSend : function() {
              $('#refGroup .input-group-addon').html('<img src="{{ asset('images/system/spinner.gif') }}" />');
            },
            success: function(res) {
              
              if(res.isValid === true){
                $('#refGroup .input-group-addon').html("<i class='fa fa-check'></i>");
                $('#refGroup').removeClass('has-error');
                $('#refGroup').addClass('has-success');
              }else{
                $('#refGroup').removeClass('has-sucess');
                $('#refGroup').addClass('has-error');
                $('#refGroup .input-group-addon').html("<i class='fa fa-times'></i>");
              }

              $('#refMsg').text(res.name);
            }
          });
        }else{
          $('#refGroup').removeClass('has-error has-success');
          $('#refGroup .input-group-addon').html("<i class='fa fa-times'></i>");
          $('#refMsg').text('');

        }
      });

      $('#nextStep').click(function(e) {
        e.preventDefault();
        let ref = $('#ref').val();
        if(ref.length > 0){
          getCustomerData(ref);
          getDeliveryTable(ref);
        }
      });

      function getCustomerData(ref) {
        $.ajax({
          url : "{{ route('deliveryNext') }}",
          method : "POST",
          dataType : "JSON",
          data : {ref : ref},
          beforeSend : function() {
            
          },
          success: function(res) {
            showTabs();
            $('#cName').val(res.name);
            $('#cAddress').val(res.address);
            $('#cProduct').val(res.product);
            $('#cQuantity').val(res.quantity);
            $('#cDeleveryDue').val(res.quantity - res.delivered);
          },
          error: function() {
            console.log('something wrong');
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

      function getDeliveryTable(ref) {
        $.ajax({
          url : "{{ route('delivery.table') }}",
          method : "POST",
          dataType: "JSON",
          data : {ref : ref},
          beforeSend : function() {
            
          }, 
          success : function(res) {
            $('#deliveryTable').html(res);
            console.log(res);
          }
        });
      }

      $('#deliverySubmit').click(function(e) {
        e.preventDefault();
        StoreDeliveryData();
      });

      function StoreDeliveryData() {
        let _data = {
          ref         : $('#ref').val(),
          d_ref       : $('#d_ref').val(),
          quantity    : $('#quantity').val(),
          driver      : $('#driver').val(),
          destination : $('#destination').val()
        };

        $.ajax({
          url : "{{ route('SaveDelivery') }}",
          method : "POST",
          dataType : "JSON",
          data : _data,
          beforeSend : function() {
            $('#d_ref_group, #quantity_group, #driver_group').removeClass('has-error has-feedback');
            $('#d_ref_group .invalid-feedback, #quantity_group .invalid-feedback, #driver_group .invalid-feedback').html('&nbsp;');
          },
          success : function(res) {
            Swal(res.t, res.m, res.s);
            getCustomerData($('#ref').val());
            getDeliveryTable($('#ref').val());
            $('#d_ref').val('');
            $('#quantity').val('');
            $('#driver').val('');
            $('#destination').val('');
            newDRef();
          },
          error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, item) {
              let group = key + '_group';
                $('#'+group).addClass('has-error has-feedback');
                $('#'+group +' .invalid-feedback').text(item);
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