@extends('layouts.master')

@section('title')
  <title>Due Pay</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Due
        <small>Make Customer Payment</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/due">Due</a></li>
      </ol>
    </section>

    <style>
      .overlay{
        display: none;
      }
    </style>
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

              <h3 class="box-title">Input Referance</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <form class="form-horizontal" id="stepFrom">
                <div class="form-group" id="refGroup">
                  <label for="ref" class="col-sm-3 control-label">Ref</label>

                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="ref" placeholder="Ref">
                    <span class="help-block" id="refMsg" style="transition: 0.5s;"></span>
                  </div>
                </div>

              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="nextStep">Next Step</button>
              </div>
              </form>
              <!-- /.box-footer -->
          </div>


          <div class="box box-solid" style="position: relative;">
            <div class="overlay" id="p_overlay"><img src="images/spinner.gif"></div>
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Payment</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none" id="deleveryProductBody">
              <form class="form-horizontal" id="dueForm">
              
                <div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="description" placeholder="Description" autocomplete="off">
                  </div>
                </div>

                <div class="form-group" id="amount_group">
                  <label for="amount" class="col-sm-3 control-label">Amount</label>

                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="amount" placeholder="Amount" autocomplete="off">
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

                </form>
              </div>

              <div class="box-footer" id="deleveryProductFooter">
                <button type="submit" id="dueSubmit" class="btn btn-info pull-right">Submit</button>
              </div>
          </div>

        <pre id="console"></pre>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">


          <!-- customer info -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Customer Information</h3>

              <div class="box-tools pull-right">
                <span class="align_center d_none" id="cih_loader"><img src="images/spinner.gif"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none" id="csInfo" style="position: relative;">
              <div class="overlay" id="ci_overlay"><img src="images/spinner.gif"></div>
              <form class="form-horizontal">
              
                <div class="form-group">
                  <label for="cName" class="col-sm-4 control-label">Name</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control" id="cName">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cAddress" class="col-sm-4 control-label">Address</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control" id="cAddress">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cProduct" class="col-sm-4 control-label">Product</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control" id="cProduct">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cRate" class="col-sm-4 control-label">Rate</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control" id="cRate">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cTotal" class="col-sm-4 control-label">Total</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control" id="cTotal">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cDue" class="col-sm-4 control-label">Due Amount</label>

                  <div class="col-sm-8">
                    <input disabled type="text" class="form-control" id="cDue">
                  </div>
                </div>

                </form>
              </div>

          </div>



          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Due Pay History</h3>

              <div class="box-tools pull-right">
                <span class="align_center d_none" id="dph_loader"><img src="images/spinner.gif"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

              <div class="box-body border-radius-none" id="csDel" style="position: relative;">
                <div class="overlay" id="bph_overlay"><img src="images/spinner.gif"></div>
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
          getPaymentTable(ref);
        }
      });
      
      $('#stepFrom').submit(function(e) {
        e.preventDefault();
        let ref = $('#ref').val();
        if(ref.length > 0){
          getCustomerData(ref);
          getPaymentTable(ref);
        }
      });

      function getCustomerData(ref) {
        $.ajax({
          url : "{{ route('due.detail') }}",
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
            $('#cRate').val(res.rate);
            $('#cTotal').val(res.total);
            $('#cDue').val(res.due - res.paid);
          },
          error: function() {
            console.log('something wrong');
          }
        });
      }


      function getPaymentTable(ref) {
        $.ajax({
          url : "{{ route('due.table') }}",
          method : "POST",
          dataType: "JSON",
          data : {ref : ref},
          beforeSend : function() {
            
          }, 
          success : function(res) {
            $('#deliveryTable').html(res);
          },
          error : function(xhr, status, error){
            $("#console").html(xhr.responseText);
          }
        });
      }

      $('#dueSubmit').click(function(e) {
        e.preventDefault();
        StoreDuePayData();
      });

      function StoreDuePayData() {
        let _data = {
          ref         : $('#ref').val(),
          description : $('#description').val(),
          amount      : $('#amount').val()
        };

        $.ajax({
          url : "{{ route('due.save') }}",
          method : "POST",
          dataType : "JSON",
          data : _data,
          beforeSend : function() {
            $('#amount_group').removeClass('has-error has-feedback');
            $('#amount_group .invalid-feedback').html('&nbsp;');
          },
          success : function(res) {
            $('#console').text(res);
            Swal(res.t, res.m, res.s);
            getCustomerData($('#ref').val());
            getPaymentTable($('#ref').val());
            $('#d_ref').val('');
            $('#quantity').val('');
            $('#driver').val('');
            $('#destination').val('');
          },
          error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $("#console").html(xhr.responseText);
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