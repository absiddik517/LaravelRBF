@extends('layouts.master')

@section('title')
  <title>Sell Product</title>
@endsection


@section('body')
	<section class="content-header">
      <h1>
        Product
        <small>Sell Product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sell<li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <!-- Main row -->

      <style>
        .center{
          position: absolute;
          left:50%;
          transform: translate(-50%);
        }
        .center img{
          display: none;
        }
      </style>
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sell Product</h3>
              <span class="center"><img src="images/spinner.gif" alt="sellsPanel"></span>
              <div class="box-tools pull-right">
                <button type="button" id="contractor_btn" class="btn bg-red btn-sm" title="Is a contractor?"><i class="fa fa-user"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <form method="POST" action="" class="form-horizontal needs-validation" novalidate id="sellForm">
              
              <div class="box-body border-radius-none">

                <div class="form-group" id="ref_group">
                  <label for="ref" class="col-sm-3 control-label">Reference</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input type="text" data-intype="number" class="form-control" id="ref" name="ref" placeholder="Reference" autocomplete="off">
                      <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="name_group">
                  <label for="name" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="address_group">
                  <label for="address" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Customer Address" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
				
				        <div class="form-group" id="phone_group">
                  <label for="phone" class="col-sm-3 control-label">Phone</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="phone" name="phone"  data-intype="number" 
                         data-inputmask="'mask': ['99999999999']" data-mask placeholder="Customer Phone Number">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="product_id_group">
                  <label for="product_id" class="col-sm-3 control-label">Select Product</label>

                  <div class="col-sm-9">
                    <select id="product_id" name="product_id" class="form-control" style="width: 100%;">
	                  <option value="" selected="selected">Product</option>
	                @php
                     $products = App\Model\Products::all();
                    @endphp

                    @foreach ($products as $product)
                      <option value="{{ $product['id'] }}">{{ $product['name']." - ". $product['unit']  }}</option>
                    @endforeach
	                </select>
                  <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="rate_group">
                  <label for="rate" class="col-sm-3 control-label">Rate</label>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-6">
                          <input type="text" data-intype="number" class="form-control" id="rate" name="rate" placeholder="Rate" autocomplete="off">
                      </div>
                      <div class="col-xs-6">
                         <div class="input-group">
                             <input type="text" data-intype="number" class="form-control" id="transport_rate" name="rate" placeholder="Transport Rate" autocomplete="off">
                             <span class="input-group-addon">
                                 <a id="transport_toggle" data-status="on" href="#">Off</a>
                             </span>
                         </div>
                      </div>
                      
                    </div>

                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="quantity_group">
                  <label for="quantity" class="col-sm-3 control-label">Quantity</label>
                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="quantity" name="quantity" placeholder="Product Quantity" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                
            <div class="row">
              <div class="col-xs-12 col-lg-12">
                <div class="form-group" id="product_price_group">
                  <label for="total" class="col-sm-3 control-label">Product Price</label>
                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="product_price" name="total" placeholder="Product Price" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-lg-12">
                <div class="form-group" id="transport_group">
                  <label for="total" class="col-sm-3 control-label">Transport</label>
                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="transport" name="total" placeholder="Transport" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
            </div>

                <div class="form-group" id="total_group">
                  <label for="total" class="col-sm-3 control-label">Total</label>
                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="total" name="total" placeholder="Total" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="paid_group">
                  <label for="paid" class="col-sm-3 control-label">Paid</label>
                  <div class="col-sm-9">
                    <input type="text" data-intype="number" class="form-control" id="paid" name="paid" placeholder="Paid Amount" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="form-group" id="due_group">
                  <label for="due" class="col-sm-3 control-label">Due</label>
                  <div class="col-sm-9">
                    <input disabled type="text" class="form-control" id="due" name="due" placeholder="Due" autocomplete="off">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <span class="pull-right">
                  <button type="submit" class="btn btn-info" id="sellProduct">Submit</button>
                </span>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

<pre id="console"></pre>
          <!-- solid sales graph -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Last sells history</h3>

              <div class="box-tools pull-right">
                <span class="center"><img src="images/spinner.gif" alt="lastPanel"></span>
                <span id="InvoiceBtn"></span>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              

                <div class="form-group-custom">
                  <label for="lref" class="col-sm-3 control-label">Reference</label>

                  <div class="col-sm-9">
                    <p class="lastText" id="lref">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="lname" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <p class="lastText" id="lname">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="laddress" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-9">
                    <p class="lastText" id="laddress">&nbsp;</p>
                  </div>
                </div>
				
				        <div class="form-group-custom">
                  <label for="lphone" class="col-sm-3 control-label">Phone</label>

                  <div class="col-sm-9">
                    <p class="lastText" id="lphone">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="lproduct" class="col-sm-3 control-label">Product</label>

                  <div class="col-sm-9">
                    <p class="lastText" id="lproduct">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="lrate" class="col-sm-3 control-label">Rate</label>
                  <div class="col-sm-9">
                    <p class="lastText" id="lrate">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="lquantity" class="col-sm-3 control-label">Quantity</label>
                  <div class="col-sm-9">
                    <p class="lastText" id="lquantity">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="ltotal" class="col-sm-3 control-label">Total</label>
                  <div class="col-sm-9">
                    <p class="lastText" id="ltotal">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="lpaid" class="col-sm-3 control-label">Paid</label>
                  <div class="col-sm-9">
                    <p class="lastText" id="lpaid">&nbsp;</p>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label for="ldue" class="col-sm-3 control-label">Due</label>
                  <div class="col-sm-9">
                    <p class="lastText" id="ldue">&nbsp;</p>
                  </div>
                </div>

              </div>
          
          </div>


        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>

@endsection

@section('script')
  <script>
    $(document).ready(function() {
      let obj = {
        ajax_called : 0,
        old_ref : $('#ref').val(),
        new_ref : false,
      };
      console.log(obj);

      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });

      NewReference();
      function NewReference() {
        $.ajax({
          url : '{{ route('new_ref') }}',
          method : 'POST',
          dataType : 'JSON',
          data : {
            query : 'getNewReference'
          },
          beforeSend : function() {
            $('#ref_group .input-group-addon').html('<img src="{{ asset('images/system/spinner.gif') }}">');
          }, 
          success: function(res) {
            $('#ref_group .input-group-addon').html('<i class="fa fa-check"></i>');
            obj.new_ref = res[0]['ref'] + 1;
            obj.ajax_called++;
            replace_ref();
          },
          error: function(error) {
            console.log(error);
          }
        });
      }

      function replace_ref() {
        obj.old_ref = $('#ref').val();
        $('#ref').val(obj.new_ref);
      }

      $('#sellForm').submit(function(e) {
        e.preventDefault();
        submit_sells_form();
      });

      function submit_sells_form() {
        let _data = {
          ref       : $('#ref').val(),
          name      : $('#name').val(),
          address   : $('#address').val(),
          phone     : $('#phone').val(),
          product_id: $('#product_id').val(),
          quality   : $('#quality').val(),
          rate      : $('#rate').val(),
          transport_rate : $('#transport_rate').val(),
          quantity  : $('#quantity').val(),
          product_price  : $('#product_price').val(),
          transport      : $('#transport').val(),
          total     : $('#total').val(),
          paid      : $('#paid').val(),
          due       : $('#due').val()
        }
        
        if(_data.transport_rate == '') _data.transport_rate = 0;
        if(_data.transport == '') _data.transport = 0;
        
        if(_data.ref == ''){
          Swal('OOPS!', 'Fill out all fields', 'error');
        }else{
          $.ajax({
            url : '{{ route('addSell') }}',
            method : "POST",
            dataType : "JSON",
            data : _data,
            beforeSend : function() {

            }, 
            success : function(res) {
              console.log(res);
              Swal(res.t, res.m, res.s);
              if(res.s == 'success'){
                $('#sellForm')[0].reset();
                rates.transport_rate = undefined;
                $('#transport_toggle').text('Off');
                init();
                NewReference();
                LastHistory()
                console.log(obj);
              }
            },
            error: function(xhr, status, error) {
              let msg = '';
              let errors = xhr.responseJSON.errors;
              let groups = ['ref', 'name', 'address', 'phone', 'product', 'quality', 'rate', 'quantity', 'total', 'paid', 'due'];
              let blank = [];
              $.each(errors, function(key, item) {
                let group = key+'_group';
                  $('#'+group).addClass('has-error has-feedback');
                  $('#'+group +' .invalid-feedback').text(item);
                  blank.push(key);
              });
              $.each(groups, function(key, item) {
                  let group = item+'_group';
                  if($.inArray(item, blank) == -1){
                    console.log(item + ' is valid');
                    $('#'+group).removeClass('has-error has-feedback');
                    $('#'+group +' .invalid-feedback').text('');
                  }
              });
            }
          });
        }
      }

      LastHistory();
      function LastHistory() {
        $.ajax({
          url : '{{ route('lastsell') }}',
          method : "POST", 
          dataType : "JSON",
          data : {},
          beforeSend : function() {
            console.log('request for last sells');
          },
          success : function(res) {
            let data = res;
            console.log(data);

            $('#lref').text(data.ref);
            $('#lname').text(data.name);
            $('#laddress').text(data.address);
            $('#lphone').text(data.phone);
            $('#lproduct').text(data.product);
            $('#lrate').text(data.rate);
            $('#lquantity').text(data.quantity);
            $('#ltotal').text(data.total);
            $('#lpaid').text(data.paid);
            $('#ldue').text(data.due);
            $('#InvoiceBtn').html(data.invoice);
          },
          error : function(xhr, status, error){
            $('#console').html(xhr.responseText);
          }
         
        });
      }

      let rates = {
          status : undefined,
          transport_rate : undefined
      };
      
      function getRate(value) {
        if(value > 0){
          $.ajax({
            url : "{{ route('product.rate') }}",
            method : "POST",
            dataType : "JSON",
            data: {
              product_id : value
            },
            beforeSend : function() {
              $('#rate').val('');
            },
            success : function(res) {
              $('#rate').val(res.rate);
              if(rates.status == 'enabled'){
                  $('#transport_rate').val(res.transport_rate);
              }
              rates.transport_rate = res.transport_rate;
            }
          });
        }else{
          $('#rate').val('');
        }
      }

      $('#product_id').on('change', function() {
        let id = $(this).val();
        getRate(id);
      });


      function calculate() {
        let rate = $('#rate').val();
        let trate = $('#transport_rate').val();
        let quantity = $('#quantity').val();
        let product_price = Math.round(rate * quantity);
        let transport = Math.round(trate * quantity);
        let total = product_price + transport;
        $('#product_price').val(product_price);
        $('#transport').val(transport);
        $('#total').val(total);
        $('#paid').val(total);
      }

      function calculate_due() {
        let x = {
            total : parseFloat($('#total').val()),
            paid : parseFloat($('#paid').val())
        }
        
        if(isNaN(x.total)){ x.total = 0;}
        if(isNaN(x.paid)){ x.paid = 0;}
        let due = x.total - x.paid;

        $('#due').val(due);
      }
      
      function calculate_total(){
          let x = {
              product_price : parseFloat($('#product_price').val()),
              transport : parseFloat($('#transport').val())
          }
          if(isNaN(x.product_price)){x.product_price = 0; }
          if(isNaN(x.transport)){x.transport = 0; }
          let total = x.product_price + x.transport;
          $('#total').val(total);
          $('#paid').val(total);
      }
      $('#product_price, #transport').keyup(function(){
          calculate_total();
      });
      $('#quantity, #rate, #transport_rate').keyup(function() {
        calculate();
        $('#paid').val($('#total').val());
      });

      $('#paid').keyup(function() {
        calculate_due();
      });
      
      $('#transport_toggle').click(function(e){
          e.preventDefault();
          toggleStatus();
          init();
      });
      
      function toggleStatus(){
          ($('#transport_toggle').text() == 'Off') ? $('#transport_toggle').text('On') : $('#transport_toggle').text('Off');
      }
      init();
      function init(){
          ($('#transport_toggle').text() == 'Off') ? $('#transport_rate, #transport').attr('disabled', 'disabled') : $('#transport_rate, #transport').removeAttr('disabled');
          ($('#transport_toggle').text() == 'Off') ? rates.status = 'disabled' : rates.status = 'enabled';
          if($('#transport_toggle').text() == 'On' && rates.status !== undefined){
              $('#transport_rate').val(rates.transport_rate);
              calculate();
          }else{
              $('#transport_rate').val('');
              calculate();
              $('#transport').val('');
          }
          
          if($('#transport_toggle').text() == 'Off'){
              $('#transport_group').slideUp(200);
              $('#product_price_group').slideUp(200);
          }else{
              $('#transport_group').slideDown(200);
              $('#product_price_group').slideDown(200);
              
          }
          
      }
      



    });
  </script>
@endsection