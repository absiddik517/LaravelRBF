@extends('layouts.master')

@section('title')
  <title>Add Cost</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Cost
        <small>Record Cost</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/cost">Cost</a></li>
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
          <div class="box box-solid">
            
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Add Cost</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>


            <div class="box-body border-radius-none">
              
              <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs bg-aqua">
                    <li class="active"><a href="#normal_tab" data-toggle="tab">Normal Cost</a></li>
                    <li><a href="#submit_tab" data-toggle="tab">Submit Cash</a></li>
                    <li><a href="#worker_tab" data-toggle="tab" class="worker_tab">Worker</a></li>
                    <li><a href="#party_tab" data-toggle="tab">Party</a></li>
                    <li><a href="#staff_tab" data-toggle="tab">Staff</a></li>
                    <li><a href="#dealer_tab" data-toggle="tab">Dealer</a></li>
                  </ul>
                  <div class="tab-content">

                    <div class="tab-pane active" id="normal_tab">
                      <div class="alert alert-warn"><center>Normal Cost</center></div>
                      <form class="form-horizontal" id="normal_form" method="POST">
                        @csrf
                        <div class="overlay" id="form_loader"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

                        <div class="description_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="description form-control" placeholder="Description">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="amount_group form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Amount</label>
                          <div class="col-sm-10">
                            <input type="text" data-intype="number" class="amount form-control" placeholder="Amount">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger pull-right">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                        <!-- Submit cash tab content -->
                    <div class="tab-pane" id="submit_tab">
                      <div class="alert alert-warn"><center>Submit Cash</center></div>
                      <form class="form-horizontal" id="submit_form">
                        <div class="overlay" id="form_loader"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

                        <div class="owner_id_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Owner</label>
                          <div class="col-sm-10">
                            <select class="owner_id form-control">
                                @foreach(App\Model\Owner::get() as $key)
                                    <option value="{{ $key['id'] }}">{{ $key['name_en'] }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="description_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="description form-control" placeholder="Description">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="amount_group form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Amount</label>
                          <div class="col-sm-10">
                            <input type="text" data-intype="number" class="amount form-control" placeholder="Amount">
                            <div class="invalid-feedback"></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger pull-right">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!-- worker payment tab content -->
                    <div class="tab-pane" id="worker_tab">
                      <div class="alert alert-warn"><center>Worker Selery</center></div>
                      <form class="form-horizontal" id="worker_form">
                        <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>

                        <div class="worker_id_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Worker Name</label>
                          <div class="col-sm-10">
                            
                            <select class="worker_id form-control">
                              <option value="">Select Worker Name</option>
                              @foreach(App\Model\Workers::get() as $worker)
                                <option value="{{ $worker['id'] }}">{{ $worker['name'] }}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Balance</label>
                          <div class="col-sm-10">
                            <input type="text" disabled="disabled" data-intype="number" class="balance form-control" placeholder="Balance">
                          </div>
                        </div>

                        <div class="amount_group form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Amount</label>
                          <div class="col-sm-10">
                            <input type="text" data-intype="number" class="amount form-control" placeholder="Amount">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger pull-right">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    
                    <!-- worker payment tab content -->
                    <div class="tab-pane" id="party_tab">
                      <div class="alert alert-warn"><center>Party Cost</center></div>
                      <form class="form-horizontal" id="party_form">
                        <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>

                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Select Party Type</label>
                          <div class="col-sm-10">
                            <select class="party_type form-control">
                              <option value="">Select One</option>
                              @foreach(App\Model\PartyType::get() as $party)
                              <option value="{{ $party['id'] }}">{{ $party['name'] }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="party_id_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Select Sardar</label>
                          <div class="col-sm-10">
                            <select class="party_id form-control">
                              <option value="">Select One</option>
                            </select>
                            <div class="invalid-feedback"></div>
                          </div>
                        </div>

                        <div class="payment_type_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Select Payment Type</label>
                          <div class="col-sm-10">
                            <select class="payment_type form-control">
                              <option value="">Select One</option>
                            </select>
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="description_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="description form-control" placeholder="Description">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="amount_group form-group">
                          <label for="inputEmail" data-intype="number" class="col-sm-2 control-label">Amount</label>
                          <div class="col-sm-10">
                            <input type="text" class="amount form-control" placeholder="Amount">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger pull-right">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!-- staff payment tab content -->
                    <div class="tab-pane" id="staff_tab">
                      <div class="alert alert-warn"><center>Staff Selery</center></div>
                      <form class="form-horizontal" id="staff_form">
                        <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>

                        <div class="staff_id_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Staff Name</label>
                          <div class="col-sm-10">
                            
                            <select class="staff_id form-control">
                              <option value="">Select One</option>
                              @foreach(App\Model\Staff::get() as $staff)
                                <option value="{{ $staff['id'] }}">{{ $staff['name'] }}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="amount_group form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Amount</label>
                          <div class="col-sm-10">
                            <input type="text" data-intype="number" class="amount form-control" placeholder="Amount">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger pull-right">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    
                    <!-- dealer payment tab content -->
                    <div class="tab-pane" id="dealer_tab">
                      <div class="alert alert-warn"><center>Dealer Payment</center></div>
                      <form class="form-horizontal" id="dealer_form">
                        <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>

                        <div class="dealer_id_group form-group">
                          <label for="inputName" class="col-sm-2 control-label">Dealer Name</label>
                          <div class="col-sm-10">
                           
                            <select class="dealer_id form-control">
                              <option value="">Select Dealer</option>
                              @foreach(App\Model\Dealer::get() as $dealer)
                                <option value="{{ $dealer['id'] }}">{{ $dealer['name'] }}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="provider_group form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Provider</label>
                          <div class="col-sm-10">
                            <input type="text" class="provider form-control" placeholder="Provider">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="amount_group form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Amount</label>
                          <div class="col-sm-10">
                            <input type="text" data-intype="number" class="amount form-control" placeholder="Amount">
                            <span class="invalid-feedback"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger pull-right">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>



                    
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>

            </div>
          </div>
          
          <pre id="console"></pre>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">


          <!-- solid sales graph -->
          <div class="box box-solid">
            <div class="overlay" id="last_history_loader"><img src="images/spinner.gif" alt=""></div>
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Cost Today</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive" id="today_cost_table"></div>
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
      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });
      
      /*let config = {
          allow_advance : undefined,
          billing_system : undefined
      };*/
      
      $('#normal_form').submit(function(e){
        e.preventDefault();
        StoreNormalCost();
      });
      
      $('#submit_form').submit(function(e){
        e.preventDefault();
        StoreSubmitCash();
      });
      
      $('#staff_form').submit(function(e){
        e.preventDefault();
        StoreStaffPayment();
      });
      
      $('#worker_form').submit(function(e){
        StoreWorkerPayment();
        e.preventDefault();
      });
      
      $('#dealer_form').submit(function(e){
        StoreDealerPayment();
        e.preventDefault();
      });
      
      init_party_form();
      
      $("#party_form").on('change', '.party_type', function(){
        let selected = $(this).val();
        if(selected == ''){
          init_party_form();
        }else{
          getSardar(selected);
          init_payment_option();
        }
      });
      
      $('#party_form').submit(function(e){
          e.preventDefault();
          let type = $('#party_form select.payment_type').val();
          if(type.length > 0){
              StorePartyPayment();
          }else{
              Swal('Error', 'Cannot submit request. Atleast select Payment type', 'error');
          }
      });
      
      
      function StoreNormalCost(){
        let _data = {
          description : $('#normal_form .description').val(),
          amount : $('#normal_form .amount').val()
        };
        
        $.ajax({
          url : "{{ route('cost.create') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $('#normal_form .overlay').show();
            $('#normal_form .form-group').removeClass('has-error has-feedback');
            $('#normal_form .invalid-feedback').text('');
          }, 
          success : function(res){
            $('#normal_form .overlay').hide();
            Swal(res.t, res.m, res.s);
            $('#normal_form')[0].reset();
            
          },
          error : function(xhr, status, error){
            $('#normal_form .overlay').hide();
            $('#console').html(xhr.responseText);
            
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, item) {
              let group = '#normal_form .'+ key + '_group';
                $(group).addClass('has-error has-feedback');
                $(group +' .invalid-feedback').text(item);
            });
          }
        });
      }
      
      function StoreSubmitCash(){
        let form = "#submit_form";
        let _data = {
          owner_id : $(form + ' select.owner_id').val(),
          description : $(form + ' input.description').val(),
          amount : $(form + ' input.amount').val()
        };
        
        $.ajax({
          url : "{{ route('SubmitCash.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            
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
      
      function StoreStaffPayment(){
        let form = "#staff_form";
        let _data = {
          staff_id : $(form + ' select.staff_id').val(),
          amount : $(form + ' input.amount').val()
        };
        
        $.ajax({
          url : "{{ route('StaffPayment.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            
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
      
      function StoreWorkerPayment(){
        let form = "#worker_form";
        let _data = {
          worker_id : $(form + ' select.worker_id').val(),
          amount : $(form + ' input.amount').val()
        };
        
        $.ajax({
          url : "{{ route('workerPayment.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            if(res.s == 'success'){
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
      }
      
      function StoreDealerPayment(){
        let form = "#dealer_form";
        let _data = {
          dealer_id : $(form + ' select.dealer_id').val(),
          provider : $(form + ' input.provider').val(),
          amount : $(form + ' input.amount').val()
        };
        
        $.ajax({
          url : "{{ route('dealerPayment.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            
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
      
      function StorePartyPayment(){
        let form = "#party_form";
        let payment_type = $(form + ' select.payment_type').val();
        let route = '';
        if(payment_type == 'bill'){
            route = "{{ route('party.bill.store') }}";
        }else{
            route = "{{ route('party.daily_advance.store') }}";
        }
        
        let _data = {
          party_id : $(form + ' select.party_id').val(),
          description : $(form + ' input.description').val(),
          amount : $(form + ' input.amount').val()
        };
        
        $.ajax({
          url : route,
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            init_party_form();
            
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
      
      
      function getSardar(party){
        $.ajax({
            url : "{{ route('party.list.select') }}",
            method : 'post', 
            dataType : 'json',
            data : {
                party_type : party
            },
            beforeSend : function(){
                
            },
            success : function(res){
                $('#party_form .party_id').html(res.option);
                /*config.allow_advance = res.config.allow_daily_advance;
                config.billing_system = res.config.billing_system;*/
                init_payment_option(res.config);
            },
            error: function(xhr, status, error){
                $('#console').html(xhr.responseText);
            }
        });
      }
      
      function init_payment_option(config){
          let optionText = config.billing_system;
          let options = '<option value="">Select One</option>';
              options += '<option value="bill">'+optionText+' Bill</option>';
          if(config.allow_daily_advance == 'true'){
              options += '<option value="daily_advance">Daily Advance</option>';
          }else{
              options += '<option disabled value="daily_advance">Daily Advance</option>';
          }
          
          $('#party_form .payment_type').html(options);
          $('#console').text(config.allow_daily_advance);
      }
      
      function init_party_form(){
          let optionText = "Select Party Type";
          let option = '<option value="">'+optionText+'</option>';
          let form = '#party_form';
          $(form + ' .party_id, ' + form + ' .payment_type').html(option);
      }
      
      $('#worker_form select.worker_id').change(function(){
          let id = $(this).val();
          if(id.length > 0){
              $.ajax({
                  url : "{{ route('worker.detail') }}",
                  method : 'post',
                  dataType : 'json',
                  data : {
                      id : id
                  },
                  beforeSend : function(){
                    $('#worker_form div.overlay').show();
                  }, 
                  success : function(res){
                    $('#worker_form div.overlay').hide();
                    $('#worker_form input.balance').val(res.balance);
                  },
                  error: function (xhr, status, error){
                    $('#console').html(xhr.responseText);
                  }
              });
          }
      });
      
      $('a.worker_tab').click(function(){
          $('#worker_form')[0].reset();
      });
      
      
    });
  </script>

@endsection